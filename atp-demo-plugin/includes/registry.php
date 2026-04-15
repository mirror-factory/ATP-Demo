<?php
/**
 * ATP Demo Shortcode Registry
 * Each group has shortcodes with a tag, label, description, and default HTML.
 * Content is stored in WP options (atp_sc_{tag}) — editable from the admin page.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function atp_demo_get_registry() {
    return [


/* ══════════════════════════════════════════════════════════════
   CANDIDATE PAGE TEMPLATE
   Full showcase campaign landing page with example content.
   Shortcode tags: atp_cand_*
   Uses John Stacy example data. When generating for a real
   candidate, AI replaces all content via the Page JSON workflow.
══════════════════════════════════════════════════════════════ */
[
'group' => 'Candidate Page',
'shortcodes' => [

[
'tag'   => 'atp_cand_styles',
'label' => 'Candidate Page — Styles',
'desc'  => 'Complete CSS for the candidate landing page including all sections: nav, hero, stats, about, messages, issues, endorsements, video, volunteer, donate, social, footer.',
'default' => <<<'HTML'
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<style>
/* ── Reset & Variables ── */
html{scroll-behavior:smooth}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
.cand-page{
  --navy:#0B1C33;--navy-light:#142640;--red:#E60000;--red-dark:#b30000;
  --cream:#F9F9F7;--white:#FFFFFF;--gold:#C4A84F;
  --text:#111;--text-light:#555;--text-muted:#888;--border:#e0e0e0;
  --font-head:'Merriweather',serif;--font-body:'Inter',sans-serif;
  --container:1100px;--nav-h:72px;
  font-family:var(--font-body);color:var(--text);background:var(--cream);
  -webkit-font-smoothing:antialiased;line-height:1.6;
}
.cand-page a{color:inherit;text-decoration:none}
.cand-container{max-width:var(--container);margin:0 auto;padding:0 24px}

/* ── GSAP Reveal ── */
.cand-reveal{opacity:0;transform:translateY(30px)}
.cand-reveal-left{opacity:0;transform:translateX(-40px)}
.cand-reveal-right{opacity:0;transform:translateX(40px)}
.cand-reveal-scale{opacity:0;transform:scale(.92)}
.cand-stagger>*{opacity:0;transform:translateY(20px)}

/* ── Scroll Progress ── */
.cand-progress{position:fixed;top:0;left:0;height:3px;background:var(--red);z-index:9999;transition:width .15s}

/* ── Nav ── */
.cand-nav{position:sticky;top:0;z-index:1000;background:var(--navy);border-bottom:4px solid var(--red)}
.cand-nav-inner{display:flex;align-items:center;justify-content:space-between;height:var(--nav-h);gap:20px}
.cand-nav-brand{display:flex;align-items:center;gap:12px}
.cand-nav-name{font-family:var(--font-head);font-size:18px;font-weight:700;color:#fff!important;letter-spacing:-.01em}
.cand-nav-badge{font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--red);background:rgba(230,0,0,.15);padding:4px 10px;border-radius:2px}
.cand-nav-links{display:flex;align-items:center;gap:6px}
.cand-nav-link{font-size:13px;font-weight:500;color:rgba(255,255,255,.7)!important;padding:8px 14px;border-radius:2px;transition:all .2s;letter-spacing:.01em}
.cand-nav-link:hover{color:#fff!important;background:rgba(255,255,255,.08)}
.cand-nav-cta{font-size:12px;font-weight:700;color:#fff!important;background:var(--red)!important;padding:10px 24px;border-radius:2px;letter-spacing:.06em;text-transform:uppercase;transition:background .2s;margin-left:8px}
.cand-nav-cta:hover{background:var(--red-dark)!important}
.cand-nav-toggle{display:none;background:none;border:none;cursor:pointer;padding:6px}
.cand-nav-toggle svg{width:26px;height:26px;stroke:#fff;stroke-width:2;fill:none}
.cand-nav-mobile{display:none;position:absolute;top:var(--nav-h);left:0;right:0;background:var(--navy);border-top:1px solid rgba(255,255,255,.1);padding:16px 24px;flex-direction:column;gap:4px}
.cand-nav-mobile.open{display:flex}
.cand-nav-mobile a{color:rgba(255,255,255,.8)!important;padding:12px 0;font-size:15px;border-bottom:1px solid rgba(255,255,255,.06)}

/* ── Hero ── */
.cand-hero{background:var(--navy);padding:80px 0 72px;position:relative;overflow:hidden}
.cand-hero-bg{position:absolute;inset:0;background:url('https://placehold.co/1920x1080/0B1C33/0B1C33?text=+') center/cover no-repeat;opacity:.25;animation:cand-ken-burns 25s ease-in-out infinite alternate}
@keyframes cand-ken-burns{0%{transform:scale(1) translate(0,0)}100%{transform:scale(1.12) translate(-2%,-1%)}}
.cand-hero::after{content:'';position:absolute;bottom:0;left:0;right:0;height:6px;background:linear-gradient(90deg,var(--red) 33%,var(--white) 33% 66%,#3C3B6E 66%);z-index:2}
.cand-hero-grid{display:grid;grid-template-columns:1fr 360px;gap:56px;align-items:center;position:relative;z-index:1}
.cand-hero-label{font-size:12px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--red);margin-bottom:14px}
.cand-hero-title{font-family:var(--font-head);font-size:56px;font-weight:900;line-height:1.08;color:#fff;margin-bottom:20px}
.cand-hero-intro{font-size:17px;line-height:1.75;color:rgba(255,255,255,.78);margin-bottom:32px;max-width:540px}
.cand-hero-ctas{display:flex;gap:14px;flex-wrap:wrap}
.cand-hero-cta{display:inline-flex;align-items:center;gap:8px;font-size:13px;font-weight:700;color:#fff!important;background:var(--red);padding:14px 28px;border-radius:2px;letter-spacing:.05em;text-transform:uppercase;transition:all .2s;border:none;cursor:pointer}
.cand-hero-cta:hover{background:var(--red-dark);transform:translateY(-1px)}
.cand-hero-cta-alt{display:inline-flex;align-items:center;gap:8px;font-size:13px;font-weight:600;color:#fff!important;background:transparent;padding:14px 28px;border:2px solid rgba(255,255,255,.3);border-radius:2px;letter-spacing:.03em;transition:all .2s;cursor:pointer}
.cand-hero-cta-alt:hover{border-color:#fff;background:rgba(255,255,255,.06)}
.cand-hero-photo{width:100%;border-radius:4px;border:4px solid rgba(255,255,255,.1);aspect-ratio:3/4;object-fit:cover;display:block;box-shadow:0 20px 60px rgba(0,0,0,.3)}

/* ── Stats Bar ── */
.cand-stats{background:var(--navy-light);padding:0;border-bottom:1px solid rgba(255,255,255,.06)}
.cand-stats-grid{display:grid;grid-template-columns:repeat(4,1fr);text-align:center}
.cand-stat{padding:32px 16px;border-right:1px solid rgba(255,255,255,.06)}
.cand-stat:last-child{border-right:none}
.cand-stat-number{font-family:var(--font-head);font-size:36px;font-weight:900;color:#fff;line-height:1;margin-bottom:6px;opacity:0;transform:translateY(10px);transition:opacity .6s,transform .6s}
.cand-stat-number.visible{opacity:1;transform:translateY(0)}
.cand-stat-label{font-size:12px;font-weight:500;color:rgba(255,255,255,.55);letter-spacing:.04em;text-transform:uppercase}

/* ── Section foundations ── */
.cand-section{padding:80px 0}
.cand-section-light{background:var(--white)}
.cand-section-cream{background:var(--cream)}
.cand-section-dark{background:var(--navy);color:#fff}
.cand-section-label{font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--red);margin-bottom:10px}
.cand-section-title{font-family:var(--font-head);font-size:34px;font-weight:700;line-height:1.2;color:var(--navy);margin-bottom:14px}
.cand-section-dark .cand-section-title{color:#fff}
.cand-section-subtitle{font-size:16px;color:var(--text-light);max-width:620px;margin-bottom:40px;line-height:1.75}
.cand-section-dark .cand-section-subtitle{color:rgba(255,255,255,.65)}

/* ── About ── */
.cand-about-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:48px;align-items:start}
.cand-about-text{font-size:16px;line-height:1.85;color:var(--text)}
.cand-about-text p+p{margin-top:18px}
.cand-credentials{display:flex;flex-direction:column;gap:10px}
.cand-credential{background:var(--cream);border-left:3px solid var(--red);padding:16px 20px;border-radius:0 4px 4px 0}
.cand-section-light .cand-credential{background:rgba(11,28,51,.03)}
.cand-credential-label{font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--red);margin-bottom:3px}
.cand-credential-value{font-size:14px;font-weight:500;color:var(--navy);line-height:1.5}

/* ── Key Messages ── */
.cand-messages-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.cand-message{background:var(--white);border:1px solid var(--border);border-radius:4px;padding:32px 28px;position:relative}
.cand-message-num{font-family:var(--font-head);font-size:48px;font-weight:900;color:rgba(230,0,0,.08);position:absolute;top:16px;right:20px;line-height:1}
.cand-message-title{font-family:var(--font-head);font-size:18px;font-weight:700;color:var(--navy);margin-bottom:10px;line-height:1.3}
.cand-message-text{font-size:14px;line-height:1.7;color:var(--text-light)}

/* ── Issues ── */
.cand-issues-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:1000px;margin:0 auto}
.cand-issue-card{background:var(--white);border:1px solid var(--border);border-top:3px solid var(--navy);border-radius:0 0 4px 4px;padding:28px 24px;transition:box-shadow .2s,transform .2s;text-align:left}
.cand-issue-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.06);transform:translateY(-2px)}
.cand-issue-tag{font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--red);margin-bottom:10px}
.cand-issue-name{font-family:var(--font-head);font-size:20px;font-weight:700;color:var(--navy);margin-bottom:10px;line-height:1.3}
.cand-issue-desc{font-size:14px;line-height:1.7;color:var(--text-light)}

/* ── Endorsements ── */
.cand-endorsements-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px}
.cand-endorsement{background:var(--white);border:1px solid var(--border);border-radius:4px;padding:28px 24px;position:relative;transition:box-shadow .2s}
.cand-endorsement:hover{box-shadow:0 6px 20px rgba(0,0,0,.05)}
.cand-endorsement::before{content:'\201C';font-family:var(--font-head);font-size:56px;color:var(--red);opacity:.15;position:absolute;top:6px;left:16px;line-height:1}
.cand-endorsement-quote{font-size:15px;font-style:italic;line-height:1.7;color:var(--text);margin-bottom:14px;padding-left:20px}
.cand-endorsement-name{font-size:13px;font-weight:700;color:var(--navy);padding-left:20px}
.cand-endorsement-role{font-size:12px;color:var(--text-muted);padding-left:20px;margin-top:2px}

/* ── Video ── */
.cand-video-wrap{position:relative;width:100%;max-width:800px;margin:0 auto;border-radius:6px;overflow:hidden;box-shadow:0 16px 48px rgba(0,0,0,.3)}
.cand-video-wrap video{width:100%;display:block;border-radius:6px}
.cand-video-play{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(11,28,51,.4);transition:opacity .4s,background .2s;cursor:pointer;border-radius:6px}
.cand-video-play:hover{background:rgba(11,28,51,.2)}
.cand-video-play svg{width:72px;height:72px;filter:drop-shadow(0 4px 12px rgba(0,0,0,.3))}
.cand-video-caption{text-align:center;margin-top:16px;font-size:13px;color:rgba(255,255,255,.5);font-style:italic}

/* ── Volunteer / Get Involved ── */
.cand-section-stripes{background:var(--navy);position:relative;overflow:hidden}
.cand-section-stripes::before{content:'';position:absolute;inset:0;background:repeating-linear-gradient(-45deg,transparent,transparent 28px,rgba(255,255,255,.03) 28px,rgba(255,255,255,.03) 56px)}
.cand-section-stripes .cand-section-label{color:rgba(255,255,255,.4)}
.cand-section-stripes .cand-section-title{color:#fff}
.cand-section-stripes .cand-section-subtitle{color:rgba(255,255,255,.6)}
.cand-involve-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;position:relative;z-index:1}
.cand-involve-card{background:rgba(255,255,255,.07);backdrop-filter:blur(4px);border:1px solid rgba(255,255,255,.1);border-radius:4px;padding:32px 24px;text-align:center;transition:box-shadow .2s,transform .2s}
.cand-involve-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.2);transform:translateY(-3px);background:rgba(255,255,255,.1)}
.cand-involve-icon{width:56px;height:56px;background:rgba(230,0,0,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
.cand-involve-icon svg{width:24px;height:24px;stroke:var(--red);stroke-width:2;fill:none}
.cand-involve-title{font-family:var(--font-head);font-size:18px;font-weight:700;color:#fff;margin-bottom:8px}
.cand-involve-text{font-size:13px;line-height:1.6;color:rgba(255,255,255,.65);margin-bottom:16px}
.cand-involve-btn{font-size:12px;font-weight:700;color:#fff!important;border:2px solid rgba(255,255,255,.3);padding:8px 20px;border-radius:2px;letter-spacing:.04em;text-transform:uppercase;transition:all .2s;display:inline-block}
.cand-involve-btn:hover{background:#fff;color:var(--navy)!important;border-color:#fff}

/* ── Survey / Typeform ── */
.cand-survey{text-align:center}
.cand-survey-embed{max-width:720px;margin:0 auto;border-radius:8px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.08);border:1px solid var(--border)}
.cand-survey-embed iframe{width:100%;height:500px;border:none;display:block}
.cand-survey-placeholder{background:var(--white);padding:48px 32px;text-align:center}
.cand-survey-placeholder-title{font-family:var(--font-head);font-size:22px;font-weight:700;color:var(--navy);margin-bottom:8px}
.cand-survey-placeholder-text{font-size:14px;color:var(--text-light);margin-bottom:20px}
.cand-survey-placeholder-btn{display:inline-block;font-size:13px;font-weight:700;color:#fff!important;background:var(--red);padding:12px 28px;border-radius:2px;letter-spacing:.04em;text-transform:uppercase;transition:background .2s}
.cand-survey-placeholder-btn:hover{background:var(--red-dark)}

/* ── Donate ── */
.cand-donate{text-align:center;padding:88px 0}
.cand-donate-title{font-family:var(--font-head);font-size:38px;font-weight:900;margin-bottom:14px;color:#fff}
.cand-donate-sub{font-size:17px;color:rgba(255,255,255,.7);margin-bottom:36px;max-width:520px;margin-left:auto;margin-right:auto;line-height:1.7}
.cand-donate-btn{display:inline-flex;align-items:center;gap:8px;font-size:16px;font-weight:700;color:var(--navy)!important;background:#fff;padding:18px 48px;border-radius:2px;letter-spacing:.05em;text-transform:uppercase;transition:all .2s;border:none;cursor:pointer;box-shadow:0 4px 16px rgba(0,0,0,.15)}
.cand-donate-btn:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(0,0,0,.25)}

/* ── Donate Page ── */
.cand-donate-page{background:var(--white);padding:80px 0 60px}
.cand-donate-page-inner{max-width:760px;margin:0 auto;text-align:center}
.cand-donate-page-intro{font-size:16px;line-height:1.75;color:var(--text-light);max-width:580px;margin:0 auto 32px}
.cand-donate-embed{max-width:640px;margin:0 auto;border-radius:8px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.08);border:1px solid var(--border)}
.cand-donate-embed iframe{width:100%;height:600px;border:none;display:block}
.cand-donate-alt{margin-top:32px;padding:24px;background:var(--cream);border-radius:6px;max-width:640px;margin-left:auto;margin-right:auto}
.cand-donate-alt-title{font-family:var(--font-head);font-size:16px;font-weight:700;color:var(--navy);margin-bottom:6px}
.cand-donate-alt-text{font-size:13px;color:var(--text-light);line-height:1.6}
.cand-donate-alt a{color:var(--red);font-weight:600;text-decoration:underline}

/* ── Contact Page ── */
.cand-contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:start}
.cand-contact-info{display:flex;flex-direction:column;gap:16px}
.cand-contact-card{display:flex;gap:16px;align-items:flex-start;padding:20px;background:var(--cream);border-radius:4px;border-left:3px solid var(--red)}
.cand-contact-card-icon{width:40px;height:40px;background:rgba(230,0,0,.08);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cand-contact-card-icon svg{width:18px;height:18px;stroke:var(--red);stroke-width:2;fill:none}
.cand-contact-card-label{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--red);margin-bottom:2px}
.cand-contact-card-value{font-size:15px;color:var(--navy);line-height:1.5}
.cand-contact-card-value a{color:var(--navy);text-decoration:underline}
.cand-contact-card-value a:hover{color:var(--red)}
.cand-contact-embed{border-radius:8px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.06);border:1px solid var(--border)}
.cand-contact-embed iframe{width:100%;height:580px;border:none;display:block}
@media(max-width:768px){.cand-contact-grid{grid-template-columns:1fr}}

/* ── Legal / Policy Pages ── */
.cand-legal{background:var(--white);padding:80px 0 60px}
.cand-legal-container{max-width:760px;margin:0 auto;padding:0 24px}
.cand-legal-meta{font-size:12px;color:var(--text-muted);margin-bottom:24px;line-height:1.6}
.cand-legal h1{font-family:var(--font-head);font-size:32px;font-weight:700;color:var(--navy);margin-bottom:8px;line-height:1.2}
.cand-legal h2{font-family:var(--font-head);font-size:20px;font-weight:700;color:var(--navy);margin:32px 0 10px;padding-top:16px;border-top:1px solid var(--border)}
.cand-legal h3{font-size:15px;font-weight:700;color:var(--navy);margin:20px 0 8px}
.cand-legal p{font-size:15px;line-height:1.8;color:var(--text);margin-bottom:12px}
.cand-legal ul,.cand-legal ol{margin:8px 0 16px 24px;font-size:15px;line-height:1.8;color:var(--text)}
.cand-legal li{margin-bottom:4px}
.cand-legal a{color:var(--red);text-decoration:underline}
.cand-legal strong{color:var(--navy)}

/* ── Issues Page ── */
.cand-issues-page-card{background:var(--white);border:1px solid var(--border);border-radius:4px;margin-bottom:24px;overflow:hidden}
.cand-issues-page-header{background:var(--navy);padding:20px 28px}
.cand-issues-page-header h3{font-family:var(--font-head);font-size:22px;font-weight:700;color:#fff;margin:0}
.cand-issues-page-body{padding:24px 28px}
.cand-issues-page-body p{font-size:15px;line-height:1.8;color:var(--text);margin-bottom:12px}
.cand-issues-page-body p:last-child{margin-bottom:0}
.cand-issues-page-tag{display:inline-block;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--red);background:rgba(230,0,0,.06);padding:3px 10px;border-radius:2px;margin-bottom:12px}

/* ── Social ── */
.cand-social{display:flex;gap:16px;flex-wrap:wrap;justify-content:center}
.cand-social-link{display:flex;align-items:center;justify-content:center;width:48px;height:48px;background:var(--white);border:1px solid var(--border);border-radius:50%;transition:all .2s}
.cand-social-link:hover{border-color:var(--red);background:var(--red);transform:translateY(-2px);box-shadow:0 6px 16px rgba(230,0,0,.15)}
.cand-social-link svg{width:20px;height:20px;fill:var(--navy);transition:fill .2s}
.cand-social-link:hover svg{fill:#fff}
.cand-social-sig{font-family:var(--font-head);font-size:28px;font-weight:700;color:var(--navy);font-style:italic;margin-top:24px;letter-spacing:-.01em}

/* ── Footer ── */
.cand-footer{background:var(--navy);padding:48px 0;text-align:center;border-top:4px solid var(--red)}
.cand-footer-disclaimer{font-size:12px;color:rgba(255,255,255,.5);margin-bottom:10px;line-height:1.6;font-weight:500}
.cand-footer-legal{font-size:11px;color:rgba(255,255,255,.3);line-height:1.6}
.cand-footer-legal a{color:rgba(255,255,255,.45)!important;text-decoration:underline;transition:color .2s}
.cand-footer-legal a:hover{color:rgba(255,255,255,.7)!important}

/* ── Responsive ── */
@media(max-width:900px){
  .cand-messages-grid,.cand-involve-grid{grid-template-columns:1fr}
  .cand-stats-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:768px){
  .cand-hero-grid{grid-template-columns:1fr;text-align:center}
  .cand-hero-title{font-size:36px}
  .cand-hero-intro{margin-left:auto;margin-right:auto}
  .cand-hero-ctas{justify-content:center}
  .cand-hero-photo{max-width:280px;margin:0 auto}
  .cand-about-grid{grid-template-columns:1fr}
  .cand-issues-grid{grid-template-columns:1fr 1fr}
  .cand-endorsements-grid{grid-template-columns:1fr}
  .cand-nav-links{display:none}
  .cand-nav-toggle{display:block}
  .cand-section{padding:56px 0}
  .cand-section-title{font-size:28px}
  .cand-donate-title{font-size:28px}
  .cand-stat-number{font-size:28px}
}
@media(max-width:480px){
  .cand-stats-grid{grid-template-columns:1fr 1fr}
  .cand-hero-title{font-size:26px}
  .cand-container{padding:0 16px}
}
</style>
HTML,
],

[
'tag'   => 'atp_cand_nav',
'label' => 'Candidate Page — Navigation',
'desc'  => 'Sticky nav with candidate name, office badge, page links, and donate CTA. Includes scroll progress bar and mobile menu.',
'default' => <<<'HTML'
<div class="cand-page">
<div class="cand-progress" id="cand-scroll-progress"></div>
<nav class="cand-nav">
  <div class="cand-container cand-nav-inner">
    <div class="cand-nav-brand">
      <span class="cand-nav-name">John Stacy</span>
      <span class="cand-nav-badge">County Commissioner</span>
    </div>
    <div class="cand-nav-links">
      <a href="#about" class="cand-nav-link">About</a>
      <a href="#issues" class="cand-nav-link">Issues</a>
      <a href="#endorsements" class="cand-nav-link">Endorsements</a>
      <a href="#involved" class="cand-nav-link">Get Involved</a>
      <a href="https://secure.anedot.com/stacy-for-commissioner/donate" class="cand-nav-cta" target="_blank" rel="noopener">Donate</a>
    </div>
    <button class="cand-nav-toggle" aria-label="Menu" onclick="document.getElementById('cand-mobile-menu').classList.toggle('open')">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <div class="cand-nav-mobile" id="cand-mobile-menu">
      <a href="#about">About</a>
      <a href="#issues">Issues</a>
      <a href="#endorsements">Endorsements</a>
      <a href="#involved">Get Involved</a>
      <a href="https://secure.anedot.com/stacy-for-commissioner/donate" target="_blank" rel="noopener">Donate</a>
    </div>
  </div>
</nav>
HTML,
],

[
'tag'   => 'atp_cand_hero',
'label' => 'Candidate Page — Hero',
'desc'  => 'Hero with tagline, intro, dual CTAs, and headshot photo. Patriotic stripe at bottom.',
'default' => <<<'HTML'
<section class="cand-hero">
  <div class="cand-hero-bg" style="background-image:url('https://placehold.co/1920x1080/142640/142640?text=+')"></div>
  <div class="cand-container cand-hero-grid">
    <div>
      <div class="cand-hero-label">Republican for County Commissioner &bull; Precinct 4, Rockwall County, Texas</div>
      <h1 class="cand-hero-title">The Choice<br>for the People.</h1>
      <p class="cand-hero-intro">A 6th generation Texan, 16-year Fate resident, and local business owner &mdash; Commissioner John Stacy has spent three years stabilizing county taxes, advancing long-delayed road projects, and standing firm for responsible growth. Now he&rsquo;s running for a second term to keep Rockwall County moving forward.</p>
      <div class="cand-hero-ctas">
        <a href="#issues" class="cand-hero-cta">See Where I Stand &darr;</a>
        <a href="https://secure.anedot.com/stacy-for-commissioner/donate" class="cand-hero-cta-alt" target="_blank" rel="noopener">Donate Now</a>
      </div>
    </div>
    <div>
      <img src="https://placehold.co/600x800/0B1C33/E60000?text=John+Stacy" alt="John Stacy" class="cand-hero-photo">
    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_stats',
'label' => 'Candidate Page — Stats Bar',
'desc'  => 'Key metrics bar: years of experience, jobs created, taxpayer savings, military service.',
'default' => <<<'HTML'
<section class="cand-stats">
  <div class="cand-container">
    <div class="cand-stats-grid">
      <div class="cand-stat">
        <div class="cand-stat-number">16 Years</div>
        <div class="cand-stat-label">Fate Resident</div>
      </div>
      <div class="cand-stat">
        <div class="cand-stat-number">$50M</div>
        <div class="cand-stat-label">Road Bonds Unlocked</div>
      </div>
      <div class="cand-stat">
        <div class="cand-stat-number">6th Gen</div>
        <div class="cand-stat-label">Texan</div>
      </div>
      <div class="cand-stat">
        <div class="cand-stat-number">3 Years</div>
        <div class="cand-stat-label">Taxes Stabilized</div>
      </div>
    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_about',
'label' => 'Candidate Page — About',
'desc'  => 'Full bio with credentials sidebar. Uses real example content from John Stacy intake.',
'default' => <<<'HTML'
<section class="cand-section cand-section-light" id="about">
  <div class="cand-container">
    <div class="cand-section-label">About the Candidate</div>
    <h2 class="cand-section-title">Meet John Stacy</h2>
    <div class="cand-about-grid">
      <div class="cand-about-text">
        <p>John Stacy is a 6th generation Texan and 16-year resident of Fate, Texas. He graduated from TCU with a B.S. in Chemistry and built a successful insurance agency in his hometown &mdash; John Stacy Insurance Services. He and his wife Amie have been married for over 23 years and are raising three sons in Rockwall County.</p>
        <p>Before running for Commissioner, John served on the Fate City Council, the Economic Development Corporation, the Planning &amp; Zoning Committee, three terms on the Fate Charter Review Committee, and the Rockwall County Historical Commission. He&rsquo;s been Scoutmaster of Troop 163 in Fate and a member of Ridgeview Church since 2009.</p>
        <p>Since taking office, Commissioner Stacy has stabilized county taxes, ended the diversion of voter-approved road funds, and moved the Trip 21 bond program forward &mdash; including unanimous approval to sell $50 million in road bonds to unlock major congestion-relief projects. He won his first election in 2022 with 61% of the vote and is running for a second term to keep Rockwall County on track.</p>
        <p>In 2024, John was named <strong>Royse City Hometown Hero</strong> by the Chamber of Commerce. In March 2025, State Representative Katrina Pierson honored him with an official resolution for his dedicated service to Precinct 4. &ldquo;It is both an honor and a privilege to serve the wonderful residents of my precinct,&rdquo; Stacy said.</p>
      </div>
      <div class="cand-credentials">
        <div class="cand-credential">
          <div class="cand-credential-label">Profession</div>
          <div class="cand-credential-value">Owner, John Stacy Insurance Services &mdash; Fate, TX</div>
        </div>
        <div class="cand-credential">
          <div class="cand-credential-label">Education</div>
          <div class="cand-credential-value">Texas Christian University (TCU), B.S. Chemistry</div>
        </div>
        <div class="cand-credential">
          <div class="cand-credential-label">Community Service</div>
          <div class="cand-credential-value">Fate City Council, EDC, Planning &amp; Zoning, Scoutmaster Troop 163</div>
        </div>
        <div class="cand-credential">
          <div class="cand-credential-label">Family</div>
          <div class="cand-credential-value">Married to Amie (23 years), three sons, Ridgeview Church member since 2009</div>
        </div>
        <div class="cand-credential">
          <div class="cand-credential-label">Awards</div>
          <div class="cand-credential-value">Royse City Hometown Hero (2024), State Rep. Pierson Resolution (2025)</div>
        </div>
        <div class="cand-credential">
          <div class="cand-credential-label">Running For</div>
          <div class="cand-credential-value">Incumbent &mdash; Republican Primary, March 3, 2026</div>
        </div>
        <div class="cand-credential">
          <div class="cand-credential-label">2022 Election</div>
          <div class="cand-credential-value">Won with 61% of the vote</div>
        </div>
      </div>
    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_messages',
'label' => 'Candidate Page — Key Messages',
'desc'  => 'Three key campaign messages in numbered cards. Maps to key_messages from intake Step 3.',
'default' => <<<'HTML'
<section class="cand-section cand-section-cream">
  <div class="cand-container">
    <div class="cand-section-label">What I&rsquo;ve Delivered &mdash; And What&rsquo;s Next</div>
    <h2 class="cand-section-title">A Four-Year Plan for Rockwall County</h2>
    <div class="cand-messages-grid">
      <div class="cand-message">
        <div class="cand-message-num">01</div>
        <h3 class="cand-message-title">Finish the Roads We Voted For</h3>
        <p class="cand-message-text">I ended the diversion of voter-approved road bond funds and secured unanimous approval to sell $50 million in Trip 21 road bonds. In my second term, I&rsquo;ll see these congestion-relief projects through to completion &mdash; on time and on budget.</p>
      </div>
      <div class="cand-message">
        <div class="cand-message-num">02</div>
        <h3 class="cand-message-title">Keep Taxes Stable While We Grow</h3>
        <p class="cand-message-text">In three years, I helped stabilize county taxes while managing one of the fastest-growing counties in Texas. Growth should pay for itself through impact fees and responsible development &mdash; not by raising property taxes on existing residents.</p>
      </div>
      <div class="cand-message">
        <div class="cand-message-num">03</div>
        <h3 class="cand-message-title">Stand Firm Against Outside Developer Interests</h3>
        <p class="cand-message-text">Rockwall County&rsquo;s future should be decided by its residents, not outside developers. I&rsquo;ll continue to fight for responsible growth that protects our quality of life, our agricultural land, and our community character.</p>
      </div>
    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_issues',
'label' => 'Candidate Page — Issues',
'desc'  => 'Five issue cards with full position text from the John Stacy example intake.',
'default' => <<<'HTML'
<section class="cand-section cand-section-cream" id="issues">
  <div class="cand-container" style="text-align:center">
    <div class="cand-section-label">Where I Stand</div>
    <h2 class="cand-section-title" style="margin-left:auto;margin-right:auto">Key Issues</h2>
    <p class="cand-section-subtitle">A full-time commissioner focused on the issues that matter most to Rockwall County families &mdash; roads, taxes, responsible growth, and transparent government.</p>
    <div class="cand-issues-grid">

      <div class="cand-issue-card">
        <div class="cand-issue-tag">Roads &amp; Infrastructure</div>
        <h3 class="cand-issue-name">Trip 21 Road Bond Program</h3>
        <p class="cand-issue-desc">Voters approved road bonds &mdash; and I made sure those funds went where they were promised. I secured unanimous approval to sell $50 million in bonds to unlock major congestion-relief projects across the county. In my second term, these projects get built.</p>
      </div>

      <div class="cand-issue-card">
        <div class="cand-issue-tag">Fiscal Responsibility</div>
        <h3 class="cand-issue-name">Tax Stabilization</h3>
        <p class="cand-issue-desc">In three years on the court, I helped stabilize county taxes while managing explosive growth. I believe new development should pay its fair share through impact fees &mdash; not shift the burden onto existing homeowners through property tax increases.</p>
      </div>

      <div class="cand-issue-card">
        <div class="cand-issue-tag">Growth Management</div>
        <h3 class="cand-issue-name">Responsible Development</h3>
        <p class="cand-issue-desc">Rockwall County is one of the fastest-growing counties in Texas. I&rsquo;m standing firm against outside developer interests that want to build without paying for roads, schools, and public safety. Growth is welcome &mdash; but it must be managed responsibly.</p>
      </div>

      <div class="cand-issue-card">
        <div class="cand-issue-tag">Transparency</div>
        <h3 class="cand-issue-name">Full-Time, Accountable Leadership</h3>
        <p class="cand-issue-desc">I ran on a promise to be a full-time commissioner &mdash; and I&rsquo;ve kept it. Monthly video newsletters, open-door policy, and a Calendly link so any constituent can book time with me directly. That&rsquo;s how government should work.</p>
      </div>

      <div class="cand-issue-card" style="border-top-color:var(--red)">
        <div class="cand-issue-tag" style="color:var(--navy)">Community</div>
        <h3 class="cand-issue-name">Trusted by Leaders</h3>
        <p class="cand-issue-desc">Endorsed by law enforcement, veterans organizations, community leaders, and the Rockwall County Republican Party. John Stacy has earned the trust of the people who know Precinct 4 best.</p>
      </div>

    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_endorsements',
'label' => 'Candidate Page — Endorsements',
'desc'  => 'Four endorsement cards with real quotes from the John Stacy example intake.',
'default' => <<<'HTML'
<section class="cand-section cand-section-light" id="endorsements">
  <div class="cand-container">
    <div class="cand-section-label">Endorsements</div>
    <h2 class="cand-section-title">Trusted by Leaders</h2>
    <p class="cand-section-subtitle">Community leaders, organizations, and elected officials who stand behind John Stacy.</p>
    <div class="cand-endorsements-grid">

      <div class="cand-endorsement">
        <p class="cand-endorsement-quote">John Stacy has my full support. He&rsquo;s the kind of leader who shows up and gets the job done.</p>
        <div class="cand-endorsement-name">Sheriff Terry Garrett</div>
        <div class="cand-endorsement-role">Rockwall County Sheriff</div>
      </div>

      <div class="cand-endorsement">
        <p class="cand-endorsement-quote">A proven leader who served his country and now wants to serve his community.</p>
        <div class="cand-endorsement-name">Texas Veterans Coalition</div>
        <div class="cand-endorsement-role">Official Endorsement</div>
      </div>

      <div class="cand-endorsement">
        <p class="cand-endorsement-quote">John&rsquo;s work on the facilities committee saved taxpayers $2.3 million. Imagine what he&rsquo;ll do on the Commissioner&rsquo;s Court.</p>
        <div class="cand-endorsement-name">Dr. Sarah Mitchell</div>
        <div class="cand-endorsement-role">Rockwall ISD Board President</div>
      </div>

      <div class="cand-endorsement">
        <div class="cand-endorsement-name">Rockwall County Republican Party</div>
        <div class="cand-endorsement-role">Official Endorsement &mdash; March 2026</div>
      </div>

    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_video',
'label' => 'Candidate Page — Video',
'desc'  => 'Campaign video section with 16:9 placeholder and play button overlay.',
'default' => <<<'HTML'
<section class="cand-section cand-section-dark" id="video">
  <div class="cand-container" style="text-align:center">
    <div class="cand-section-label" style="color:rgba(255,255,255,.4)">Campaign Video</div>
    <h2 class="cand-section-title" style="color:#fff;margin-bottom:32px">Watch: My Vision for Rockwall County</h2>
    <div class="cand-video-wrap">
      <video id="cand-video-player" playsinline preload="metadata" poster="" style="width:100%;display:block;aspect-ratio:16/9;object-fit:cover;border-radius:6px">
        <source src="https://commissionerjohnstacy.com/wp-content/uploads/2025/12/Stacy-Staircase-Survey-Video-FINAL.mp4" type="video/mp4">
      </video>
      <div class="cand-video-play" id="cand-video-play-btn" onclick="var v=document.getElementById('cand-video-player');var b=document.getElementById('cand-video-play-btn');if(v.paused){v.play();b.style.opacity='0';b.style.pointerEvents='none';}else{v.pause();b.style.opacity='1';b.style.pointerEvents='auto';}">
        <svg viewBox="0 0 80 80" fill="none"><circle cx="40" cy="40" r="38" fill="rgba(230,0,0,.9)" stroke="white" stroke-width="2"/><polygon points="32,24 32,56 58,40" fill="white"/></svg>
      </div>
    </div>
    <p class="cand-video-caption">Commissioner Stacy &mdash; Voter Survey Update</p>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_volunteer',
'label' => 'Candidate Page — Get Involved',
'desc'  => 'Volunteer and engagement section with three action cards.',
'default' => <<<'HTML'
<section class="cand-section cand-section-stripes" id="involved">
  <div class="cand-container" style="text-align:center;position:relative;z-index:1">
    <div class="cand-section-label">Get Involved</div>
    <h2 class="cand-section-title" style="margin-left:auto;margin-right:auto">Join the Campaign</h2>
    <p class="cand-section-subtitle" style="margin-left:auto;margin-right:auto;text-align:center">Every campaign is powered by its community. Here&rsquo;s how you can help John Stacy bring real leadership to Rockwall County.</p>
    <div class="cand-involve-grid">
      <div class="cand-involve-card">
        <div class="cand-involve-icon">
          <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
        </div>
        <h3 class="cand-involve-title">Volunteer</h3>
        <p class="cand-involve-text">Knock doors, make calls, or help at events. We&rsquo;ll match your skills and schedule to where you&rsquo;re needed most.</p>
        <a href="#" class="cand-involve-btn">Sign Up</a>
      </div>
      <div class="cand-involve-card">
        <div class="cand-involve-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3 class="cand-involve-title">Attend Events</h3>
        <p class="cand-involve-text">Town halls, meet-and-greets, and community forums. Come hear John&rsquo;s plans in person and ask questions.</p>
        <a href="#" class="cand-involve-btn">See Events</a>
      </div>
      <div class="cand-involve-card">
        <div class="cand-involve-icon">
          <svg viewBox="0 0 24 24"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>
        </div>
        <h3 class="cand-involve-title">Spread the Word</h3>
        <p class="cand-involve-text">Share our message on social media, talk to your neighbors, or display a yard sign. Word of mouth wins local races.</p>
        <a href="#" class="cand-involve-btn">Get Materials</a>
      </div>
    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_survey',
'label' => 'Candidate Page — Voter Survey',
'desc'  => 'Typeform or survey embed section. Shows a placeholder with CTA when no embed code is set, or an iframe when a Typeform/survey URL is provided.',
'default' => <<<'HTML'
<section class="cand-section cand-section-light" id="survey">
  <div class="cand-container" style="text-align:center">
    <div class="cand-section-label">Your Voice Matters</div>
    <h2 class="cand-section-title" style="margin-left:auto;margin-right:auto">Voter Priorities Survey</h2>
    <p class="cand-section-subtitle" style="margin-left:auto;margin-right:auto;text-align:center">Take 2 minutes to share what issues matter most to you and your family in Rockwall County. Your input directly shapes our campaign priorities.</p>
    <div class="cand-survey-embed">
      <iframe src="https://atp.ameritrackpolls.com/to/nhPPYcJ8" style="width:100%;height:520px;border:0;border-radius:8px" loading="lazy"></iframe>
    </div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_donate',
'label' => 'Candidate Page — Donate CTA',
'desc'  => 'Full-width donation call-to-action.',
'default' => <<<'HTML'
<section class="cand-section cand-section-dark cand-donate" id="donate">
  <div class="cand-container">
    <div class="cand-section-label" style="color:rgba(255,255,255,.4)">Support the Campaign</div>
    <h2 class="cand-donate-title">Help John Stacy Win</h2>
    <p class="cand-donate-sub">Every dollar fuels a data-driven campaign that listens to voters. Your support makes the difference in Rockwall County.</p>
    <a href="https://secure.anedot.com/stacy-for-commissioner/donate" class="cand-donate-btn" target="_blank" rel="noopener">Donate Now</a>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_social',
'label' => 'Candidate Page — Social & Connect',
'desc'  => 'Social media links — only platforms with URLs from the example data.',
'default' => <<<'HTML'
<section class="cand-section cand-section-cream" id="connect" style="text-align:center">
  <div class="cand-container">
    <div class="cand-section-label">Stay Connected</div>
    <h2 class="cand-section-title" style="margin-left:auto;margin-right:auto">Follow the Campaign</h2>
    <p class="cand-section-subtitle" style="margin-left:auto;margin-right:auto;text-align:center">Stay up to date on events, policy updates, and ways to get involved in Rockwall County.</p>
    <div class="cand-social">
      <a href="https://facebook.com/johnstacy4rockwallcounty" class="cand-social-link" target="_blank" rel="noopener" title="Facebook"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
      <a href="https://x.com/JohnStacyTX" class="cand-social-link" target="_blank" rel="noopener" title="X / Twitter"><svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
      <a href="https://instagram.com/stacyforcommissioner" class="cand-social-link" target="_blank" rel="noopener" title="Instagram"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5"/></svg></a>
      <a href="https://linkedin.com/in/johnstacytx" class="cand-social-link" target="_blank" rel="noopener" title="LinkedIn"><svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
    </div>
    <div class="cand-social-sig">John Stacy</div>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_footer',
'label' => 'Candidate Page — Footer',
'desc'  => 'Legal footer with paid-for-by disclaimer, committee info, and compliance page links. Includes scroll progress JS.',
'default' => <<<'HTML'
<footer class="cand-footer">
  <div class="cand-container">
    <div class="cand-footer-disclaimer">Political advertising paid for by John Stacy for Rockwall County Commissioner Precinct 4.</div>
    <div class="cand-footer-legal">
      John Stacy for Commissioner &bull; Fate, TX 75132<br>
      <a href="/privacy-policy">Privacy Policy</a> &bull;
      <a href="/cookie-policy">Cookie Policy</a> &bull;
      <a href="/sms-terms">SMS Terms</a> &bull;
      <a href="mailto:privacy@stacyforcommissioner.com">Contact</a>
    </div>
  </div>
</footer>
<script>
(function(){
  // Scroll progress bar
  window.addEventListener('scroll',function(){var d=document.documentElement;var p=(d.scrollTop/(d.scrollHeight-d.clientHeight))*100;var bar=document.getElementById('cand-scroll-progress');if(bar)bar.style.width=p+'%';});

  // Video player
  var vp=document.getElementById('cand-video-player');
  var vb=document.getElementById('cand-video-play-btn');
  if(vp&&vb){
    vp.addEventListener('ended',function(){vb.style.opacity='1';vb.style.pointerEvents='auto';});
    vp.addEventListener('click',function(){if(!vp.paused){vp.pause();vb.style.opacity='1';vb.style.pointerEvents='auto';}});
  }

  // GSAP ScrollTrigger animations
  if(typeof gsap!=='undefined'&&typeof ScrollTrigger!=='undefined'){
    gsap.registerPlugin(ScrollTrigger);

    // Reveal animations
    gsap.utils.toArray('.cand-reveal').forEach(function(el){
      gsap.to(el,{opacity:1,y:0,duration:.8,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 85%',once:true}});
    });
    gsap.utils.toArray('.cand-reveal-left').forEach(function(el){
      gsap.to(el,{opacity:1,x:0,duration:.8,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 85%',once:true}});
    });
    gsap.utils.toArray('.cand-reveal-right').forEach(function(el){
      gsap.to(el,{opacity:1,x:0,duration:.8,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 85%',once:true}});
    });
    gsap.utils.toArray('.cand-reveal-scale').forEach(function(el){
      gsap.to(el,{opacity:1,scale:1,duration:.8,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 85%',once:true}});
    });

    // Stagger children
    gsap.utils.toArray('.cand-stagger').forEach(function(container){
      gsap.to(container.children,{opacity:1,y:0,duration:.6,stagger:.12,ease:'power3.out',scrollTrigger:{trigger:container,start:'top 85%',once:true}});
    });

    // Stats counter
    gsap.utils.toArray('.cand-stat-number').forEach(function(el,i){
      gsap.to(el,{opacity:1,y:0,duration:.6,delay:i*.15,ease:'power3.out',scrollTrigger:{trigger:'.cand-stats',start:'top 80%',once:true}});
    });

    // Hero entrance
    gsap.from('.cand-hero-label',{opacity:0,y:20,duration:.6,delay:.2,ease:'power3.out'});
    gsap.from('.cand-hero-title',{opacity:0,y:30,duration:.8,delay:.4,ease:'power3.out'});
    gsap.from('.cand-hero-intro',{opacity:0,y:20,duration:.6,delay:.6,ease:'power3.out'});
    gsap.from('.cand-hero-ctas',{opacity:0,y:20,duration:.6,delay:.8,ease:'power3.out'});
    gsap.from('.cand-hero-photo',{opacity:0,scale:.9,duration:1,delay:.5,ease:'power3.out'});

    // Issue cards stagger
    gsap.utils.toArray('.cand-issues-grid').forEach(function(grid){
      gsap.to(grid.querySelectorAll('.cand-issue-card'),{opacity:1,y:0,duration:.5,stagger:.1,ease:'power3.out',scrollTrigger:{trigger:grid,start:'top 80%',once:true}});
    });
    document.querySelectorAll('.cand-issue-card').forEach(function(c){c.style.opacity='0';c.style.transform='translateY(20px)';});

    // Endorsement cards
    gsap.utils.toArray('.cand-endorsements-grid').forEach(function(grid){
      gsap.to(grid.querySelectorAll('.cand-endorsement'),{opacity:1,y:0,duration:.5,stagger:.1,ease:'power3.out',scrollTrigger:{trigger:grid,start:'top 80%',once:true}});
    });
    document.querySelectorAll('.cand-endorsement').forEach(function(c){c.style.opacity='0';c.style.transform='translateY(20px)';});

    // Message cards
    gsap.utils.toArray('.cand-messages-grid').forEach(function(grid){
      gsap.to(grid.querySelectorAll('.cand-message'),{opacity:1,y:0,duration:.6,stagger:.15,ease:'power3.out',scrollTrigger:{trigger:grid,start:'top 80%',once:true}});
    });
    document.querySelectorAll('.cand-message').forEach(function(c){c.style.opacity='0';c.style.transform='translateY(20px)';});

    // Involve cards
    gsap.utils.toArray('.cand-involve-grid').forEach(function(grid){
      gsap.to(grid.querySelectorAll('.cand-involve-card'),{opacity:1,y:0,duration:.5,stagger:.12,ease:'power3.out',scrollTrigger:{trigger:grid,start:'top 80%',once:true}});
    });
    document.querySelectorAll('.cand-involve-card').forEach(function(c){c.style.opacity='0';c.style.transform='translateY(20px)';});

    // Video section
    gsap.from('.cand-video-wrap',{opacity:0,scale:.9,duration:1,ease:'power3.out',scrollTrigger:{trigger:'.cand-video-wrap',start:'top 80%',once:true}});

    // About section
    var aboutText=document.querySelector('.cand-about-text');
    var aboutCreds=document.querySelector('.cand-credentials');
    if(aboutText)gsap.from(aboutText,{opacity:0,x:-30,duration:.8,ease:'power3.out',scrollTrigger:{trigger:aboutText,start:'top 80%',once:true}});
    if(aboutCreds)gsap.from(aboutCreds,{opacity:0,x:30,duration:.8,delay:.2,ease:'power3.out',scrollTrigger:{trigger:aboutCreds,start:'top 80%',once:true}});

    // Section titles
    gsap.utils.toArray('.cand-section-label').forEach(function(el){
      gsap.from(el,{opacity:0,y:10,duration:.5,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 90%',once:true}});
    });
    gsap.utils.toArray('.cand-section-title').forEach(function(el){
      gsap.from(el,{opacity:0,y:15,duration:.6,delay:.1,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 88%',once:true}});
    });

    // Donate CTA
    gsap.from('.cand-donate-btn',{opacity:0,y:20,duration:.6,ease:'power3.out',scrollTrigger:{trigger:'.cand-donate-btn',start:'top 85%',once:true}});

    // Social icons
    gsap.utils.toArray('.cand-social').forEach(function(el){
      gsap.to(el.children,{opacity:1,y:0,duration:.4,stagger:.08,ease:'power3.out',scrollTrigger:{trigger:el,start:'top 85%',once:true}});
    });
    document.querySelectorAll('.cand-social-link').forEach(function(c){c.style.opacity='0';c.style.transform='translateY(10px)';});
  }
})();
</script>
</div><!-- .cand-page -->
HTML,
],

[
'tag'   => 'atp_cand_issues_page',
'label' => 'Candidate Page — Issues & Answers (Full Page)',
'desc'  => 'Standalone issues page with detailed policy positions. Uses real John Stacy content from commissionerjohnstacy.com/issues-answers/.',
'default' => <<<'HTML'
<section class="cand-section cand-section-light">
  <div class="cand-container" style="max-width:860px">
    <div class="cand-section-label">Issues &amp; Answers</div>
    <h2 class="cand-section-title">Where Commissioner Stacy Stands</h2>
    <p class="cand-section-subtitle">Four key issues currently being addressed by the Rockwall County Commissioner&rsquo;s Court &mdash; and what Commissioner Stacy is doing about them.</p>

    <div class="cand-issues-page-card">
      <div class="cand-issues-page-header"><h3>Growth &amp; Development Accountability</h3></div>
      <div class="cand-issues-page-body">
        <div class="cand-issues-page-tag">Protecting Taxpayers</div>
        <p>Rockwall County is one of the fastest-growing counties in Texas, and that growth must be managed responsibly. Commissioner Stacy is focused on holding developers accountable for Municipal Utility Districts (MUDs) outside city limits &mdash; ensuring new development pays its fair share of infrastructure costs rather than shifting the burden to existing taxpayers.</p>
        <p>&ldquo;Responsible development means real water, real infrastructure, and real planning,&rdquo; Stacy said. &ldquo;Rockwall County should grow on our terms &mdash; with safety, roads, and taxpayers in mind &mdash; not on the developers&rsquo; timetable.&rdquo;</p>
      </div>
    </div>

    <div class="cand-issues-page-card">
      <div class="cand-issues-page-header"><h3>Trip 21 Road Bond Program</h3></div>
      <div class="cand-issues-page-body">
        <div class="cand-issues-page-tag">$150M Voter-Approved Bonds</div>
        <p>In November 2021, voters approved a $150 million road bond with 26 listed projects. Commissioner Stacy ended the diversion of voter-approved road funds and worked to move the program forward. Even before new bond funds were issued, 11 of the 26 projects began engineering and preliminary work using $57 million in leftover funds from the 2004 and 2008 bond programs.</p>
        <p>On November 12, 2025, the Court took action to issue $50 million in new Trip 21 funding &mdash; allowing 23 of the 26 projects to now move forward. This is an aggressive and proactive effort to prepare as many projects as possible for state and federal partners to help construct.</p>
      </div>
    </div>

    <div class="cand-issues-page-card">
      <div class="cand-issues-page-header"><h3>Regional Transportation</h3></div>
      <div class="cand-issues-page-body">
        <div class="cand-issues-page-tag">Protecting Local Control</div>
        <p>Commissioner Stacy is working to ensure Rockwall County has a strong voice in regional transportation decisions, coordinating with state and federal agencies on the proposed outer loop and other major projects. Local residents deserve real solutions for congestion that reflect their priorities &mdash; not top-down plans from outside interests.</p>
      </div>
    </div>

    <div class="cand-issues-page-card">
      <div class="cand-issues-page-header"><h3>Local Road Construction</h3></div>
      <div class="cand-issues-page-body">
        <div class="cand-issues-page-tag">Building What Citizens Need</div>
        <p>Beyond the bond program, Commissioner Stacy is focused on the actual construction of roads demanded by county residents. This includes coordinating with TxDOT, managing county road maintenance, and ensuring that road projects are delivered on time and on budget. The goal is simple: build the roads citizens urgently need.</p>
      </div>
    </div>

    <div class="cand-issues-page-card" style="border-top:3px solid var(--red)">
      <div class="cand-issues-page-header" style="background:var(--red)"><h3>Full-Time, Accountable Leadership</h3></div>
      <div class="cand-issues-page-body">
        <div class="cand-issues-page-tag">Transparency</div>
        <p>Commissioner Stacy ran on a promise to be a full-time commissioner and has kept it. He publishes a monthly video newsletter, maintains an open-door policy, and offers a Calendly link so any constituent can book time directly. He took 61% of the vote running on a record of protecting taxpayers and standing up to aggressive development.</p>
        <p>After three years of stabilizing county taxes, advancing long-delayed road projects, and standing firm for responsible growth, Commissioner Stacy has outlined a focused four-year plan to keep Rockwall County moving forward &mdash; without surrendering control to outside developer interests.</p>
      </div>
    </div>

  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_privacy',
'label' => 'Candidate Page — Privacy Policy',
'desc'  => 'Full privacy policy page. Edit the candidate name, committee name, contact email, phone, and address fields to customize for each candidate.',
'default' => <<<'HTML'
<section class="cand-legal">
  <div class="cand-legal-container">
    <h1>Privacy Policy</h1>
    <div class="cand-legal-meta">
      Effective Date: December 9, 2025<br>
      Authorized by: John Stacy for Rockwall County Commissioner Precinct 4
    </div>

    <h2>1. Introduction</h2>
    <p>John Stacy for Rockwall County Commissioner Precinct 4 respects your privacy. This Policy explains how we collect, use, and protect your information when you visit our website, sign up for updates, donate, volunteer, or receive text messages from us.</p>

    <h2>2. Information We Collect</h2>
    <ul>
      <li><strong>Contact Information:</strong> name, email address, phone number, mailing address.</li>
      <li><strong>Automatically Collected Data:</strong> IP address, device and browser information, pages visited, referral URLs, and general location (via analytics/cookies).</li>
      <li><strong>Survey/Engagement Data:</strong> responses to campaign surveys, event RSVPs, volunteer interests.</li>
      <li><strong>Donation Data:</strong> amount, date, and payment method details processed by our payment processor (we do not store full payment card numbers).</li>
    </ul>

    <h2>3. How We Use Information</h2>
    <ul>
      <li>Provide updates, alerts, event information, and volunteer opportunities.</li>
      <li>Respond to questions and support requests.</li>
      <li>Improve our website and communications.</li>
      <li>Comply with applicable campaign finance and other legal requirements.</li>
    </ul>
    <p>We do not sell, rent, or trade your personal information.</p>

    <h2>4. Text Messaging (SMS/MMS)</h2>
    <p>By providing your mobile number, you consent to receive recurring campaign messages, updates, and notifications via SMS/MMS. Message frequency may vary. Message and data rates may apply.</p>
    <ul>
      <li><strong>Opt Out:</strong> Reply STOP to end all texts.</li>
      <li><strong>Help:</strong> Reply HELP or contact us at info@commissionerjohnstacy.com or (469) 939-2067.</li>
      <li><strong>Consent Not Required:</strong> You do not need to consent to receive texts to donate or volunteer.</li>
      <li><strong>Data Use:</strong> Your number is used only for campaign communications and is not shared with unauthorized third parties.</li>
    </ul>
    <p>By enrolling, you confirm you are the account holder or have permission to enroll the number provided.</p>

    <h2>5. Cookies and Tracking</h2>
    <p>We use cookies and analytics tools to operate the site, personalize content, and measure engagement. You can adjust cookie settings in your browser; disabling cookies may affect site functionality.</p>

    <h2>6. Data Security</h2>
    <p>We use industry-standard safeguards to protect your information. However, no method of transmission or storage is 100% secure, and we cannot guarantee absolute security.</p>

    <h2>7. Children&rsquo;s Privacy</h2>
    <p>Our website and text services are not intended for children under 13, and we do not knowingly collect data from children under 13.</p>

    <h2>8. Policy Updates</h2>
    <p>We may update this Policy from time to time. The latest version will be posted here with the effective date above.</p>

    <h2>9. Contact Us</h2>
    <p>
      John Stacy for Rockwall County Commissioner Precinct 4<br>
      101 East Rusk St.<br>
      Rockwall, TX 75087<br>
      Email: <a href="mailto:info@commissionerjohnstacy.com">info@commissionerjohnstacy.com</a><br>
      Phone: <a href="tel:+14699392067">(469) 939-2067</a>
    </p>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_cookies',
'label' => 'Candidate Page — Cookie, Tracking & TCPA Policy',
'desc'  => 'Full cookie/tracking/DLC10/TCPA policy page. Edit candidate name, committee, contact info to customize.',
'default' => <<<'HTML'
<section class="cand-legal">
  <div class="cand-legal-container">
    <h1>Cookie, Tracking, and DLC10 / TCPA Policy</h1>
    <div class="cand-legal-meta">
      For Commissioner John Stacy | Rockwall County, Texas<br>
      Effective Date: 12/09/2025 &bull; Last Updated: 12/09/2025
    </div>

    <p>Commissioner John Stacy (&ldquo;we,&rdquo; &ldquo;our,&rdquo; or &ldquo;us&rdquo;) is committed to transparency regarding how this website collects, uses, and stores information. This Cookie &amp; Tracking Policy explains how cookies, pixels, analytics tools, and communication technologies&mdash;including SMS/MMS systems covered under the Telephone Consumer Protection Act (TCPA) and 10DLC (DLC10) standards&mdash;operate when you visit or interact with this website.</p>
    <p>By using this website, you consent to the use of cookies and tracking technologies as described in this Policy.</p>

    <h2>1. What Are Cookies?</h2>
    <p>Cookies are small text files placed on your computer or mobile device to store information about your browsing activity. Cookies may be:</p>
    <ul>
      <li><strong>Session cookies,</strong> which are deleted when you close your browser;</li>
      <li><strong>Persistent cookies,</strong> which remain until you delete them or they expire;</li>
      <li><strong>First-party cookies,</strong> which are placed by this website;</li>
      <li><strong>Third-party cookies,</strong> which are placed by service providers such as analytics or advertising platforms.</li>
    </ul>
    <p>We use cookies to improve website performance, deliver relevant content, enhance security, and understand how visitors interact with our pages.</p>

    <h2>2. Types of Cookies We Use</h2>
    <h3>A. Strictly Necessary Cookies</h3>
    <p>These cookies are required for the site to function properly and cannot be disabled. They are used for security, authentication, load balancing, form submissions, and basic navigation.</p>
    <h3>B. Performance and Analytics Cookies</h3>
    <p>These cookies help us measure traffic and improve user experience. They may be provided by tools such as Google Analytics, Meta Pixel, or similar services. Information collected may include IP address, browser type, device type, referring URLs, pages visited, and date/time of visits. This data is generally aggregated and used for statistical purposes.</p>
    <h3>C. Functionality Cookies</h3>
    <p>These cookies enhance your experience by remembering your preferences, language settings, form values, or returning visitor recognition.</p>
    <h3>D. Advertising and Retargeting Cookies</h3>
    <p>If advertising, retargeting, or social media integrations are enabled, these cookies may measure engagement with campaign content, track visits after clicking advertisements, and understand which messages or pages are most effective.</p>

    <h2>3. DLC10 and TCPA Compliance for SMS/MMS Communications</h2>
    <p>Although cookies primarily relate to web browsing, this website may also collect and store information in connection with SMS/MMS communications sent via registered 10DLC routes. We comply with the Telephone Consumer Protection Act (TCPA), Federal Communications Commission (FCC) rules, CTIA guidelines, and 10DLC (DLC10) registration and vetting requirements.</p>
    <p>We only send SMS/MMS messages when:</p>
    <ul>
      <li>You have provided express written consent to receive messages, and</li>
      <li>You understand that messaging and data rates may apply, and</li>
      <li>You may opt out at any time by replying &ldquo;STOP&rdquo; or using another designated opt-out method, and</li>
      <li>Your consent is not a condition of receiving county services or assistance.</li>
    </ul>
    <p>If you provide your phone number through forms, surveys, QR codes, or other digital tools on this website, we may use cookies and tracking technologies to record your opt-in and consent status, store date/time of consent for compliance purposes, measure engagement with links shared via SMS/MMS, and improve the relevance and timing of messages.</p>
    <p>We do not sell or share your telephone number with third parties for their own marketing purposes.</p>

    <h2>4. Additional Technologies Used</h2>
    <h3>A. Tracking Pixels and Event Tags</h3>
    <p>We may use tracking pixels, tags, or scripts from providers such as Google, Meta, or other platforms to measure page views, engagement, traffic sources, referral paths, and conversions related to campaign goals.</p>
    <h3>B. Server Log Data</h3>
    <p>Our servers may automatically collect limited technical information including IP address, browser type, device type, date and time of access, pages viewed, and error codes.</p>
    <h3>C. Third-Party Integrations</h3>
    <p>Our website may integrate with third-party services such as survey/form tools, email/SMS delivery services, security providers, and embedded video or social media analytics. Each third party maintains its own privacy and cookie policies.</p>

    <h2>5. How You Can Control Cookies</h2>
    <p>You can manage cookies through your browser settings. Most browsers allow you to delete existing cookies, block some or all cookies, enable tracking protection or &ldquo;Do Not Track&rdquo; settings, receive alerts when a site tries to place a cookie, and use private or incognito browsing modes. Disabling certain cookies may affect the functionality and performance of this website.</p>

    <h2>6. Data Retention</h2>
    <p>We retain cookie and tracking data only for as long as necessary to fulfill operational, analytical, or legal requirements. SMS/MMS opt-in records required by TCPA, carrier rules, or DLC10 standards are retained for the periods needed to demonstrate compliance.</p>

    <h2>7. How We Protect Your Information</h2>
    <p>We use reasonable administrative, technical, and physical safeguards to help protect information collected through this website, including SSL encryption, access controls, secure hosting, regular system updates, and vendor review with contractual safeguards. We do not sell personal data to third parties.</p>

    <h2>8. Your Rights</h2>
    <p>Depending on your location, you may have the right to request access to the information we hold about you, request correction or deletion of certain information, opt out of certain cookies or tracking technologies, and withdraw consent to receive SMS, MMS, or email communications.</p>

    <h2>9. Updates to This Policy</h2>
    <p>We may update this Cookie, Tracking, and DLC10 / TCPA Policy periodically to reflect changes in technology, law, or our practices. When we do, we will revise the &ldquo;Effective Date&rdquo; at the top of this page.</p>

    <h2>10. Contact Information</h2>
    <p>
      Commissioner John Stacy<br>
      Rockwall County, Texas<br>
      Email: <a href="mailto:info@commissionerjohnstacy.com">info@commissionerjohnstacy.com</a><br>
      Phone: <a href="tel:+14699392067">(469) 939-2067</a>
    </p>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_donate_page',
'label' => 'Candidate Page — Donate (Full Page)',
'desc'  => 'Standalone donation page with embedded donation link/iframe. Edit the iframe src to point to the candidate\'s Anedot, ActBlue, WinRed, or other donation platform.',
'default' => <<<'HTML'
<section class="cand-section cand-section-dark" style="padding:48px 0">
  <div class="cand-container" style="text-align:center">
    <div class="cand-section-label" style="color:rgba(255,255,255,.4)">Support the Campaign</div>
    <h1 class="cand-section-title" style="color:#fff;font-size:38px;margin-bottom:6px">Donate to John Stacy</h1>
    <p style="font-size:16px;color:rgba(255,255,255,.6);max-width:520px;margin:0 auto;line-height:1.7">Every dollar fuels a campaign that puts Rockwall County taxpayers first.</p>
  </div>
</section>
<section class="cand-donate-page">
  <div class="cand-donate-page-inner">
    <p class="cand-donate-page-intro">Your contribution helps us keep roads funded, taxes stable, and development accountable. Commissioner Stacy is running for a second term to keep Rockwall County moving forward.</p>

    <div class="cand-donate-embed">
      <!-- Replace this iframe src with the candidate's donation platform embed URL -->
      <iframe src="https://secure.anedot.com/stacy-for-commissioner/donate" loading="lazy"></iframe>
    </div>

    <div class="cand-donate-alt">
      <div class="cand-donate-alt-title">Prefer to donate another way?</div>
      <div class="cand-donate-alt-text">
        Mail a check to: John Stacy for Commissioner, Fate, TX 75132<br>
        Or donate online at <a href="https://secure.anedot.com/stacy-for-commissioner/donate" target="_blank" rel="noopener">secure.anedot.com</a>
      </div>
    </div>

    <p style="margin-top:24px;font-size:12px;color:#888;line-height:1.5">Political advertising paid for by John Stacy for Rockwall County Commissioner Precinct 4. Contributions are not tax deductible.</p>
  </div>
</section>
HTML,
],

[
'tag'   => 'atp_cand_contact',
'label' => 'Candidate Page — Contact',
'desc'  => 'Contact page with info cards (phone, email, office, Calendly) and an embedded scheduling tool.',
'default' => <<<'HTML'
<section class="cand-section cand-section-light">
  <div class="cand-container">
    <div class="cand-section-label">Get in Touch</div>
    <h2 class="cand-section-title">Contact Commissioner Stacy</h2>
    <p class="cand-section-subtitle">Have a question, concern, or idea for Precinct 4? Commissioner Stacy maintains an open-door policy and welcomes direct communication from every constituent.</p>

    <div class="cand-contact-grid">
      <div class="cand-contact-info">

        <div class="cand-contact-card">
          <div class="cand-contact-card-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
          <div>
            <div class="cand-contact-card-label">Phone</div>
            <div class="cand-contact-card-value"><a href="tel:+14699392067">(469) 939-2067</a></div>
          </div>
        </div>

        <div class="cand-contact-card">
          <div class="cand-contact-card-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
          <div>
            <div class="cand-contact-card-label">Email</div>
            <div class="cand-contact-card-value"><a href="mailto:info@commissionerjohnstacy.com">info@commissionerjohnstacy.com</a></div>
          </div>
        </div>

        <div class="cand-contact-card">
          <div class="cand-contact-card-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
          <div>
            <div class="cand-contact-card-label">Office</div>
            <div class="cand-contact-card-value">101 East Rusk St., Suite 202<br>Rockwall, TX 75087</div>
          </div>
        </div>

        <div class="cand-contact-card">
          <div class="cand-contact-card-icon"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
          <div>
            <div class="cand-contact-card-label">Schedule a Meeting</div>
            <div class="cand-contact-card-value"><a href="https://calendly.com/commissionerjohnstacy" target="_blank" rel="noopener">Book via Calendly</a></div>
          </div>
        </div>

        <div class="cand-contact-card">
          <div class="cand-contact-card-icon"><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></div>
          <div>
            <div class="cand-contact-card-label">Social Media</div>
            <div class="cand-contact-card-value">
              <a href="https://facebook.com/johnstacy4rockwallcounty" target="_blank" rel="noopener">Facebook</a> &bull;
              <a href="https://x.com/JohnStacyTX" target="_blank" rel="noopener">X / Twitter</a> &bull;
              <a href="https://instagram.com/stacyforcommissioner" target="_blank" rel="noopener">Instagram</a>
            </div>
          </div>
        </div>

      </div>

      <div class="cand-contact-embed">
        <!-- Calendly inline embed — replace URL for different candidate -->
        <iframe src="https://calendly.com/commissionerjohnstacy" loading="lazy"></iframe>
      </div>
    </div>

  </div>
</section>
HTML,
],

]], // end Candidate Page


    ]; // end registry return
} // end function
