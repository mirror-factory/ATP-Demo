# Deployment Guide

How to deploy a new client site from intake to live.

## Prerequisites

- Client's SiteGround hosting account with domain added
- SiteGround login credentials (or ATP provides access)
- Completed V3 JSON from the intake form
- Uploaded assets in Drive or WP media

## Step 1: Build the Plugin

```bash
# From the monorepo root
./scripts/new-site.sh client-slug "Client Name" "Office Title"

# Edit the config
nano sites/client-slug/site-config.json

# Copy the intake JSON
cp /path/to/intake-output.json sites/client-slug/intake-v3.json

# Build the plugin
./scripts/build-site.sh client-slug
```

Output: `dist/client-slug/atp-campaign-site/`

## Step 2: Generate Page JSON

Take the intake JSON and run it through the AI prompt:

1. Open `PROMPT-TEMPLATE.md` — copy the full prompt
2. Paste it into Claude/ChatGPT
3. Paste the client's `intake-v3.json` where indicated
4. AI outputs Page JSON — save it

Also generate the legal pages by running the legal prompt from `README.md` Quick Start section.

## Step 3: Set Up WordPress on SiteGround

1. Log into SiteGround → Site Tools
2. WordPress → Install & Manage → Install WordPress
3. Set admin username and password
4. Note the admin URL

## Step 4: Install the Plugin

1. Zip the `dist/client-slug/atp-campaign-site/` folder
2. Go to WP Admin → Plugins → Add New → Upload Plugin
3. Upload the zip → Install → Activate

## Step 5: Run Setup Wizard

1. The setup wizard banner appears
2. Click "Run the Setup Wizard"
3. Step 1: Skip plugin installation (Elementor not needed — Canvas template auto-created)
4. Step 2: Import all 7 pages
5. Step 3: Complete

## Step 6: Import Page JSON

1. Go to ATP Shortcodes → Candidate Page
2. Paste the Page JSON from Step 2
3. Click Import Page JSON
4. Each shortcode section is now populated with the candidate's content

## Step 7: Update Legal Pages

1. Go to ATP Shortcodes
2. Find `atp_cand_privacy` — paste the generated privacy policy HTML
3. Find `atp_cand_cookies` — paste the generated cookie policy HTML
4. Save each

## Step 8: Import Media

If using Google Drive:
1. The intake JSON has Drive URLs for headshot, logo, photos
2. Download each file from Drive
3. Upload to WP Media Library
4. Update the shortcode HTML to use the WordPress media URLs

If using WordPress media (default):
- Files are already in the media library from the intake form upload

## Step 9: Configure Domain & SSL

1. SiteGround → Site Tools → Domain → Point domain to the site
2. SiteGround → Security → SSL → Install Let's Encrypt certificate
3. Set permalink structure: Settings → Permalinks → Post name
4. Set static front page: Settings → Reading → "Home" page

## Step 10: White Label

1. Go to ATP Shortcodes → White Label
2. Set client name, logo, colors
3. These apply to: login page, admin bar, dashboard widget, footer

## Step 11: Review & Launch

1. Share the staging URL with ATP
2. ATP reviews with the candidate
3. Collect feedback in a single consolidated document
4. Apply edits
5. Go live
