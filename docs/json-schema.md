# V3 JSON Schema Reference

The V3 JSON schema is the contract between the intake form and every downstream system. When the form submits, it produces this exact structure. Every field on every page of the campaign website maps to a key in this schema.

## Schema File

The empty schema template lives at `packages/atp-plugin-core/v3-schema.json`. The field mapping (form field IDs → schema paths) lives at `packages/atp-plugin-core/v3-field-map.json`.

## Conventions

- **Key names:** snake_case, lowercase
- **Strings:** Empty string `""` when not provided
- **Arrays:** Empty array `[]` when no selections
- **Booleans:** `true` / `false` for acknowledgment checkboxes
- **Timestamps:** ISO 8601

## Section-by-Section

### meta
System-generated. Not from form fields.

| Key | Type | Description |
|-----|------|-------------|
| form_version | String | Always "3.0" |
| candidate_id | Integer | Auto-incremented on save |
| submitted_at | String (ISO 8601) | Submission timestamp |
| status | String | "new", "in_progress", "complete" |

### source_check → Step 1
Who filled out the form and what data sources are available.

| Key | Type | Used By |
|-----|------|---------|
| submitter_name | String | Internal only |
| submitter_email | String | Internal — notification recipient |
| submitter_phone | String | Internal only |
| submitter_role | String | Internal only |
| filing_url | String | Internal — future Ballotpedia parser |
| ballotpedia_url | String | Internal — future parser trigger |
| existing_website | String | Internal — migration reference |

### identity → Step 2
Core candidate identity. Feeds the nav, hero, footer, and legal pages.

| Key | Type | Used By |
|-----|------|---------|
| display_name | String | Nav bar, hero, page titles, footer |
| office_sought | String | Nav badge, hero label, cookie policy |
| district | String | Hero label |
| state | String | Hero label |
| party | String | Hero label |
| election_year | String | Summary display |
| election_date | String | Summary display |
| election_type | String | Summary display |
| race_status | String | Enum: Incumbent/Challenger/Open seat |

### contacts → Step 3
Campaign team contacts. Mostly internal except treasurer (footer disclaimer).

| Key | Used By |
|-----|---------|
| treasurer_name | Footer paid-for-by disclaimer |
| primary_contact_email | Contact page, notifications |
| primary_contact_phone | Contact page |
| All others | Internal — team communication |

### bio_messaging → Step 4
The core content that generates the homepage. Every field here appears on the site.

| Key | Used By |
|-----|---------|
| homepage_intro | Hero section intro paragraph |
| full_bio | About section — multi-paragraph bio |
| why_running | About section — motivation paragraph |
| tagline | Hero section H1 |
| differentiator | Issues page intro |
| key_messages | Key Messages section (3 cards) |
| endorsements_list | Endorsements section + About page |
| policy_passions | Can feed issues page content |

### platform_issues → Step 5
Issue positions. Directly generates the issues grid on the homepage and the full Issues & Answers page.

| Key | Type | Used By |
|-----|------|---------|
| issue_categories | Array (max 5) | One card per issue on issues grid |
| positions | String | Full position text per issue |
| opponents_missing_issue | String | Can be used in messaging |
| evolved_position | String | Can be used in about/issues |

### background → Step 6
Professional credentials. Feeds the About section sidebar.

| Key | Used By |
|-----|---------|
| current_profession | Credentials sidebar |
| education_1/2/3 | Credentials sidebar |
| military_branch + military_years | Credentials sidebar |

### visual_branding → Step 7
Drives the entire visual design of the site.

| Key | Type | Used By |
|-----|------|---------|
| headshot_link | String (URL) | Hero section photo |
| logo_link | String (URL) | Nav bar, white label |
| additional_photos_link | Array of URLs | About section, other pages |
| primary_color | String | CSS --navy variable |
| secondary_color | String | CSS --red variable |
| accent_color | String | CSS --accent variable |
| submission_folder | String (URL) | Admin — Drive folder link |

### social_media → Step 8
Each non-empty URL generates a social icon on the site.

| Key | Used By |
|-----|---------|
| facebook | Social section, Contact page, JSON-LD sameAs |
| x_twitter | Same |
| instagram | Same |
| youtube | Same |
| tiktok | Same |
| linkedin | Same |

### video → Step 9
Campaign video embedded on the homepage.

| Key | Used By |
|-----|---------|
| main_video_url | Video section HTML5 player |
| other_video_assets | Internal — additional media |

### survey → Step 10
Voter survey configuration.

| Key | Used By |
|-----|---------|
| include_survey_page | Controls whether Survey page is created |
| existing_survey_link | Survey section iframe src |
| page_name | Survey page title |
| placement | Where survey appears (page, homepage, both) |

### legal_compliance → Step 11
Generates both legal pages (Privacy Policy + Cookie/SMS Policy) and the site footer.

| Key | Used By |
|-----|---------|
| committee_name | [Candidate Committee Name] in legal pages |
| paid_for_by | Footer disclaimer on every page |
| committee_mailing_address | [Mailing Address] in legal pages, contact page |
| campaign_phone_legal | [Campaign Phone Number] in legal pages, contact page |
| campaign_email_legal | [Campaign Email Address] in legal pages, contact page |
| privacy_contact_email | Privacy policy contact section |
| jurisdiction | Internal — compliance routing |
| sms_message_types | Array — SMS consent categories |

### fundraising → Step 12
Generates the Donate page and donate buttons.

| Key | Used By |
|-----|---------|
| donation_page_url | Donate button href, nav CTA |
| embed_code | Donate page inline iframe |
| button_label | Donate button text |
| platform_status | Internal — billing readiness |

### domain_setup → Step 13
Mostly internal. `preferred_domain` used in legal pages.

| Key | Used By |
|-----|---------|
| preferred_domain | [Website URL] in legal pages |
| All others | Internal — hosting setup |

### approval_timeline → Step 14
Entirely internal — build process management.

### additional_services → Step 15
Entirely internal — upsell interest signals for ATP sales.

### acknowledgment → Step 16
Form completion gate. Both must be `true` to submit.

### pages_standard
Hardcoded list of Standard package pages. Conditional 9th "Survey" page.
