<?php
/**
 * Candidate Page Engine — connects intake form output to the page template.
 *
 * How it works:
 * 1. Admin selects an "active candidate" (saved as WP option) or
 *    imports a JSON file directly via the admin UI.
 * 2. When any atp_cand_* shortcode renders, the engine replaces
 *    {{field_id}} tokens with real candidate data.
 * 3. Array values (checkboxes) are joined with commas.
 * 4. Empty tokens are replaced with empty strings (no leftover {{braces}}).
 *
 * The JSON can come from:
 * - An existing intake form submission (atp_candidate CPT post)
 * - A pasted/uploaded JSON blob (stored in WP options)
 * - The example-intake.json shipped with the plugin
 *
 * @package ATPDemo
 * @since   2.0.1
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ─────────────────────────────────────────────────────────────────────────────
   Option keys
   ───────────────────────────────────────────────────────────────────────── */
define( 'ATP_CAND_SOURCE',  'atp_cand_source' );   // 'post' | 'json'
define( 'ATP_CAND_POST_ID', 'atp_cand_post_id' );  // int — CPT post ID
define( 'ATP_CAND_JSON',    'atp_cand_json' );      // string — raw JSON blob

/* ─────────────────────────────────────────────────────────────────────────────
   Token replacement — the core engine
   ───────────────────────────────────────────────────────────────────────── */

/**
 * Get the active candidate's data as a flat key=>value array.
 * Returns empty array if nothing configured.
 */
function atp_cand_get_data() {
    static $cache = null;
    if ( $cache !== null ) return $cache;

    $source = get_option( ATP_CAND_SOURCE, '' );

    if ( $source === 'post' ) {
        $pid = (int) get_option( ATP_CAND_POST_ID, 0 );
        if ( $pid && get_post_type( $pid ) === 'atp_candidate' ) {
            $raw = get_post_meta( $pid );
            $data = [];
            foreach ( $raw as $k => $v ) {
                if ( str_starts_with( $k, '_' ) ) continue; // skip WP internals
                $val = maybe_unserialize( $v[0] );
                $data[ $k ] = is_array( $val ) ? implode( ', ', $val ) : (string) $val;
            }
            $cache = $data;
            return $cache;
        }
    }

    if ( $source === 'json' ) {
        $json_str = get_option( ATP_CAND_JSON, '' );
        if ( $json_str ) {
            $parsed = json_decode( $json_str, true );
            if ( is_array( $parsed ) ) {
                $data = [];
                foreach ( $parsed as $k => $v ) {
                    if ( str_starts_with( $k, '_' ) ) continue; // skip meta keys
                    if ( is_array( $v ) ) {
                        $data[ $k ] = implode( ', ', $v );
                    } else {
                        $data[ $k ] = (string) $v;
                    }
                }
                $cache = $data;
                return $cache;
            }
        }
    }

    $cache = [];
    return $cache;
}

/**
 * Replace all {{token}} placeholders in HTML with candidate data.
 * Tokens that don't match any key are replaced with empty string.
 */
function atp_cand_replace_tokens( $html ) {
    $data = atp_cand_get_data();
    if ( empty( $data ) ) return $html;

    // Replace known tokens
    foreach ( $data as $key => $value ) {
        $html = str_replace( '{{' . $key . '}}', esc_html( $value ), $html );
    }

    // Clean up any remaining unreplaced tokens
    $html = preg_replace( '/\{\{[a-z_]+\}\}/', '', $html );

    return $html;
}

/* ─────────────────────────────────────────────────────────────────────────────
   Hook into shortcode rendering
   ───────────────────────────────────────────────────────────────────────── */

/**
 * Filter the generic shortcode output for atp_cand_* tags.
 * This runs AFTER the standard renderer in shortcodes.php.
 */
add_filter( 'atp_cand_shortcode_output', 'atp_cand_replace_tokens' );

/* ─────────────────────────────────────────────────────────────────────────────
   Admin page — Candidate Page Settings
   ───────────────────────────────────────────────────────────────────────── */

add_action( 'admin_menu', 'atp_cand_admin_menu' );

function atp_cand_admin_menu() {
    add_submenu_page(
        'atp-demo-shortcodes',
        'Candidate Page Settings',
        'Candidate Page',
        'manage_options',
        'atp-candidate-page',
        'atp_cand_admin_render'
    );
}

function atp_cand_admin_render() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $notice = '';

    // Handle save actions
    if ( isset( $_POST['atp_cand_save'] ) && check_admin_referer( 'atp_cand_settings' ) ) {
        $src = sanitize_key( $_POST['atp_cand_source_type'] ?? '' );

        if ( $src === 'post' ) {
            $pid = (int) ( $_POST['atp_cand_post'] ?? 0 );
            update_option( ATP_CAND_SOURCE, 'post' );
            update_option( ATP_CAND_POST_ID, $pid );
            $name = get_the_title( $pid ) ?: 'Candidate #' . $pid;
            $notice = '<div class="notice notice-success is-dismissible"><p>Active candidate set to <strong>' . esc_html( $name ) . '</strong> (Post #' . $pid . '). All <code>[atp_cand_*]</code> shortcodes now use this data.</p></div>';
        }

        if ( $src === 'json' ) {
            $raw = wp_unslash( $_POST['atp_cand_json_input'] ?? '' );
            $parsed = json_decode( $raw, true );
            if ( is_array( $parsed ) ) {
                update_option( ATP_CAND_SOURCE, 'json' );
                update_option( ATP_CAND_JSON, $raw, false );
                $name = $parsed['display_name'] ?? $parsed['legal_name'] ?? 'Unknown';
                $notice = '<div class="notice notice-success is-dismissible"><p>JSON imported for <strong>' . esc_html( $name ) . '</strong>. All <code>[atp_cand_*]</code> shortcodes now use this data.</p></div>';
            } else {
                $notice = '<div class="notice notice-error is-dismissible"><p>Invalid JSON. Please check the format and try again.</p></div>';
            }
        }
    }

    // Handle clear
    if ( isset( $_POST['atp_cand_clear'] ) && check_admin_referer( 'atp_cand_settings' ) ) {
        delete_option( ATP_CAND_SOURCE );
        delete_option( ATP_CAND_POST_ID );
        delete_option( ATP_CAND_JSON );
        $notice = '<div class="notice notice-success is-dismissible"><p>Candidate page data cleared. Shortcodes will show placeholder tokens.</p></div>';
    }

    // Handle load example
    if ( isset( $_POST['atp_cand_load_example'] ) && check_admin_referer( 'atp_cand_settings' ) ) {
        $example_path = ATP_DEMO_DIR . 'example-intake.json';
        if ( file_exists( $example_path ) ) {
            $json = file_get_contents( $example_path );
            update_option( ATP_CAND_SOURCE, 'json' );
            update_option( ATP_CAND_JSON, $json, false );
            $notice = '<div class="notice notice-success is-dismissible"><p>Example JSON loaded (John Stacy for County Commissioner). All <code>[atp_cand_*]</code> shortcodes now use example data.</p></div>';
        }
    }

    // Current state
    $current_source = get_option( ATP_CAND_SOURCE, '' );
    $current_post   = (int) get_option( ATP_CAND_POST_ID, 0 );
    $current_json   = get_option( ATP_CAND_JSON, '' );
    $current_data   = atp_cand_get_data();
    $current_name   = $current_data['display_name'] ?? $current_data['legal_name'] ?? '';

    // Get all candidate posts for the dropdown
    $candidates = get_posts( [ 'post_type' => 'atp_candidate', 'posts_per_page' => -1, 'post_status' => 'publish' ] );

    // Token map — all tokens used in atp_cand_* shortcodes
    $token_map = [
        'Nav'          => ['display_name', 'office'],
        'Hero'         => ['party', 'office', 'district', 'state', 'tagline', 'homepage_intro', 'headshot'],
        'About'        => ['display_name', 'bio_full', 'why_running', 'profession', 'education_1', 'position', 'election_type', 'election_year', 'military_branch', 'military_years'],
        'Issues'       => ['differentiator', 'issue_categories', 'issue_positions'],
        'Endorsements' => ['endorsements'],
        'Donate'       => ['display_name', 'donation_url', 'donation_button_label'],
        'Social'       => ['facebook', 'twitter_x', 'instagram', 'youtube', 'tiktok', 'linkedin'],
        'Footer'       => ['paidfor_text', 'committee_name', 'committee_address', 'privacy_contact_email'],
    ];
    ?>
    <div class="wrap">
        <div style="display:flex;align-items:center;gap:14px;background:#0e1235;padding:18px 28px;border-radius:6px 6px 0 0;margin:-1px -1px 0">
            <img src="<?php echo esc_url( ATP_DEMO_URL . 'assets/images/ATP-Logo-Red-White.png' ); ?>" alt="ATP" style="height:36px">
            <div>
                <h1 style="margin:0;font-size:22px;color:#fff">Candidate Page Settings</h1>
                <p style="margin:4px 0 0;color:rgba(255,255,255,.65);font-size:13px">
                    Connect intake form data to the <code style="background:rgba(255,255,255,.1);color:#d42b2b;padding:1px 6px;border-radius:3px">[atp_cand_*]</code> shortcodes.
                </p>
            </div>
        </div>

        <div style="background:#fff;border:1px solid #ddd;border-top:none;border-radius:0 0 6px 6px;padding:28px 32px">
            <?php echo $notice; // phpcs:ignore ?>

            <?php if ( $current_name ) : ?>
            <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:6px;padding:16px 20px;margin-bottom:24px;display:flex;align-items:center;gap:12px">
                <span style="background:#16a34a;color:#fff;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0">&#10003;</span>
                <div>
                    <strong style="color:#166534">Active: <?php echo esc_html( $current_name ); ?></strong>
                    <span style="color:#555;font-size:13px"> &mdash; Source: <?php echo esc_html( $current_source ); ?>
                    <?php if ( $current_source === 'post' ) echo ' (Post #' . $current_post . ')'; ?>
                    &mdash; <?php echo count( $current_data ); ?> fields loaded</span>
                </div>
            </div>
            <?php endif; ?>

            <!-- ── Source Selection ── -->
            <h2 style="font-size:16px;color:#0e1235;margin:0 0 16px;padding-bottom:8px;border-bottom:2px solid #d42b2b">Data Source</h2>

            <form method="post" style="margin-bottom:32px">
                <?php wp_nonce_field( 'atp_cand_settings' ); ?>

                <!-- Option A: From intake submission -->
                <div style="background:#f9f9f9;border:1px solid #e5e5e5;border-radius:6px;padding:20px;margin-bottom:16px">
                    <label style="display:flex;align-items:center;gap:10px;font-weight:600;font-size:14px;margin-bottom:12px;cursor:pointer">
                        <input type="radio" name="atp_cand_source_type" value="post"
                            <?php checked( $current_source, 'post' ); ?>>
                        Use an intake form submission
                    </label>
                    <?php if ( empty( $candidates ) ) : ?>
                        <p style="color:#888;font-size:13px;margin-left:26px">No intake submissions yet. Submit the <code>[atp_intake]</code> form first.</p>
                    <?php else : ?>
                        <select name="atp_cand_post" style="margin-left:26px;min-width:300px">
                            <?php foreach ( $candidates as $c ) :
                                $m = get_post_meta( $c->ID );
                                $cname = $m['display_name'][0] ?? $m['legal_name'][0] ?? $c->post_title;
                                $coffice = $m['office'][0] ?? '';
                                $cstate = $m['state'][0] ?? '';
                            ?>
                            <option value="<?php echo esc_attr( $c->ID ); ?>"
                                <?php selected( $current_post, $c->ID ); ?>>
                                <?php echo esc_html( $cname ); ?>
                                <?php if ( $coffice ) echo ' — ' . esc_html( $coffice ); ?>
                                <?php if ( $cstate ) echo ', ' . esc_html( $cstate ); ?>
                                (ID <?php echo $c->ID; ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>

                <!-- Option B: Paste JSON -->
                <div style="background:#f9f9f9;border:1px solid #e5e5e5;border-radius:6px;padding:20px;margin-bottom:16px">
                    <label style="display:flex;align-items:center;gap:10px;font-weight:600;font-size:14px;margin-bottom:12px;cursor:pointer">
                        <input type="radio" name="atp_cand_source_type" value="json"
                            <?php checked( $current_source, 'json' ); ?>>
                        Paste or import JSON directly
                    </label>
                    <p style="color:#666;font-size:13px;margin:0 0 10px 26px">
                        Paste the intake form JSON output below. Field keys must match the
                        <code>{{placeholder}}</code> tokens in the shortcodes.
                    </p>
                    <textarea name="atp_cand_json_input" rows="10"
                        style="width:calc(100% - 26px);margin-left:26px;font-family:monospace;font-size:12px;background:#0e1235;color:#7eb8f7;padding:14px;border:1px solid #ddd;border-radius:4px"
                        placeholder='Paste intake JSON here...'><?php
                        if ( $current_source === 'json' && $current_json ) {
                            echo esc_textarea( $current_json );
                        }
                    ?></textarea>
                </div>

                <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
                    <button type="submit" name="atp_cand_save" class="button button-primary button-hero" style="font-size:14px">
                        Save &amp; Activate
                    </button>
                    <button type="submit" name="atp_cand_load_example" class="button" style="font-size:13px">
                        Load Example JSON (John Stacy)
                    </button>
                    <?php if ( $current_source ) : ?>
                    <button type="submit" name="atp_cand_clear" class="button" style="font-size:13px;color:#b00;border-color:#b00"
                        onclick="return confirm('Clear active candidate data?')">
                        Clear Data
                    </button>
                    <?php endif; ?>
                </div>
            </form>

            <!-- ── Token Reference ── -->
            <h2 style="font-size:16px;color:#0e1235;margin:0 0 16px;padding-bottom:8px;border-bottom:2px solid #d42b2b">Token Reference</h2>
            <p style="color:#666;font-size:13px;margin-bottom:16px">
                Every <code>{{token}}</code> in the <code>[atp_cand_*]</code> shortcodes maps to an intake form field.
                When an active candidate is set, tokens are replaced with real data at render time.
            </p>

            <table class="widefat" style="margin-bottom:24px">
                <thead>
                    <tr>
                        <th style="width:120px">Shortcode</th>
                        <th>Tokens Used</th>
                        <th style="width:120px">Current Value</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ( $token_map as $section => $tokens ) : ?>
                    <tr>
                        <td><strong style="color:#0e1235"><?php echo esc_html( $section ); ?></strong></td>
                        <td>
                            <?php foreach ( $tokens as $t ) :
                                $has_val = ! empty( $current_data[ $t ] );
                            ?>
                            <code style="background:<?php echo $has_val ? '#f0fdf4' : '#fef2f2'; ?>;color:<?php echo $has_val ? '#166534' : '#991b1b'; ?>;padding:1px 6px;border-radius:3px;font-size:11px;margin:0 3px 3px 0;display:inline-block"
                            >{{<?php echo esc_html( $t ); ?>}}</code>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php
                            $filled = 0;
                            foreach ( $tokens as $t ) { if ( ! empty( $current_data[ $t ] ) ) $filled++; }
                            $pct = count( $tokens ) > 0 ? round( ( $filled / count( $tokens ) ) * 100 ) : 0;
                            $bar_color = $pct === 100 ? '#16a34a' : ( $pct > 50 ? '#ca8a04' : '#dc2626' );
                            ?>
                            <div style="display:flex;align-items:center;gap:8px">
                                <div style="flex:1;height:6px;background:#e5e5e5;border-radius:3px;overflow:hidden">
                                    <div style="width:<?php echo $pct; ?>%;height:100%;background:<?php echo $bar_color; ?>;border-radius:3px"></div>
                                </div>
                                <span style="font-size:11px;color:#888;min-width:32px"><?php echo $filled; ?>/<?php echo count( $tokens ); ?></span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- ── Quick Preview ── -->
            <?php if ( $current_name ) : ?>
            <h2 style="font-size:16px;color:#0e1235;margin:0 0 16px;padding-bottom:8px;border-bottom:2px solid #d42b2b">Active Data Preview</h2>
            <div style="max-height:400px;overflow-y:auto;background:#0e1235;border-radius:6px;padding:16px">
                <pre style="color:#7eb8f7;font-family:monospace;font-size:11px;white-space:pre-wrap;margin:0"><?php
                    $preview = $current_data;
                    // Remove section separator keys
                    $preview = array_filter( $preview, function( $k ) {
                        return ! str_starts_with( $k, '___' );
                    }, ARRAY_FILTER_USE_KEY );
                    echo esc_html( json_encode( $preview, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
                ?></pre>
            </div>
            <?php endif; ?>

        </div>
    </div>
    <?php
}
