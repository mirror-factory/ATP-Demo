# Post-Launch Editing Guide

How to make changes to a live client site after launch.

## How the Override System Works

Every piece of content on the site lives in a shortcode. Each shortcode has two possible sources:

1. **Database** (WP options table) — edits made in the Shortcode Editor
2. **Registry** (plugin code) — the default template HTML

**Database always wins.** If someone edited a shortcode in the admin, that's what renders. Plugin updates only change the registry defaults — they never touch database content.

This means:
- You can edit any section at any time without risk
- Plugin updates are safe — they won't overwrite custom content
- Clicking "Reset" on a shortcode reverts it to the plugin default

## Making Edits

### Quick Edit (simple text changes)

1. Go to WP Admin → ATP Shortcodes
2. Find the shortcode section you want to edit
3. Change the HTML directly in the editor
4. Click Save
5. Changes are live immediately

### AI-Assisted Edit (content rewrite)

1. Go to ATP Shortcodes → find the section
2. Click "Copy Code" to copy the current HTML
3. Paste into Claude/ChatGPT with instructions:
   - "Change the hero title to 'Fighting for Our Future'"
   - "Add a new issue card about healthcare"
   - "Update the bio with this new paragraph: ..."
4. AI returns updated HTML
5. Paste back into the shortcode editor → Save

### Full Page Regeneration

If major changes are needed (new candidate info, new issues, complete redesign):

1. Update the intake JSON with new data
2. Re-run the AI generation prompt
3. Import the new Page JSON — this overwrites all shortcode database values
4. Review and adjust as needed

## What Counts as "In Scope"

### Included in Standard package
- Text changes (typos, wording updates, bio edits)
- Swapping photos (new headshot, new campaign photos)
- Adding/removing issue cards (within the 5-card limit)
- Updating endorsements
- Changing colors, button labels
- Updating legal page contact info
- Embedding a new campaign video

### Additional work (quoted separately)
- New pages beyond the 7 Standard pages
- Custom functionality (event calendar, press blog, polling locator)
- Design changes to the page structure/layout
- Ongoing content management (monthly updates, blog posts)
- New integrations (email marketing, CRM, analytics)

## Adding a New Section

To add a section that doesn't exist in the template:

1. Go to the WordPress page editor
2. Add the shortcode tag in the content where you want it (e.g., between `[atp_cand_about]` and `[atp_cand_messages]`)
3. Go to ATP Shortcodes → find the new tag (or create custom HTML)
4. The new section renders in that position on the page

## Removing a Section

1. Go to the WordPress page editor
2. Delete the shortcode tag from the page content
3. Save the page
4. The section no longer renders (the shortcode data stays in the database but isn't called)

## Reordering Sections

1. Go to the WordPress page editor
2. Move the shortcode tags into the desired order
3. Save
4. Sections render in the new order
