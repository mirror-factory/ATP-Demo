# Campaign Website Pages — Complete Reference

Every Standard campaign website includes 7 pages. Each page is built from shortcode tags that render HTML from the plugin's registry (defaults) or the WordPress database (customized content).

## How Pages Work

A WordPress page's content is just a list of shortcode tags:

```
[atp_cand_styles]
[atp_cand_nav]
[atp_cand_hero]
[atp_cand_stats]
...
[atp_cand_footer]
```

When the page loads, WordPress replaces each tag with the HTML stored for that shortcode. The HTML comes from either:

1. The **database** (if someone edited it in the Shortcode Editor) — this always wins
2. The **registry default** (the template HTML in `registry.php`) — the fallback

This means plugin updates never overwrite custom edits. And any section can be edited independently without touching the others.

## Page 1: Home

**Template:** Canvas (full-width, no theme header/footer)
**Shortcodes:** 14

| Order | Shortcode | Section | What It Shows |
|-------|-----------|---------|---------------|
| 1 | `atp_cand_styles` | CSS + GSAP CDN | Design system, animations, responsive breakpoints |
| 2 | `atp_cand_nav` | Navigation | Sticky nav with candidate name, office badge, page links, donate CTA, mobile menu, scroll progress bar |
| 3 | `atp_cand_hero` | Hero | Ken Burns background, candidate name + tagline as H1, party/district/state label, intro paragraph, dual CTAs (issues + donate), headshot photo |
| 4 | `atp_cand_stats` | Stats Bar | 4 key metrics (numbers animate on scroll — fade up with stagger) |
| 5 | `atp_cand_about` | About | Multi-paragraph bio on left, credentials sidebar on right (profession, education, military, awards, community service) |
| 6 | `atp_cand_messages` | Key Messages | 3 numbered campaign commitment cards |
| 7 | `atp_cand_issues` | Issues Grid | Centered 3-column grid, up to 5 issue cards + "Trusted by Leaders" card |
| 8 | `atp_cand_endorsements` | Endorsements | Quote cards with name, role, organization |
| 9 | `atp_cand_video` | Campaign Video | HTML5 video player with play/pause overlay, loads candidate's actual video |
| 10 | `atp_cand_volunteer` | Get Involved | Navy background with diagonal flag stripes, 3 glassmorphic action cards (Volunteer, Events, Spread the Word) |
| 11 | `atp_cand_survey` | Voter Survey | Typeform/survey iframe embed |
| 12 | `atp_cand_donate` | Donate CTA | Full-width dark section with prominent donate button |
| 13 | `atp_cand_social` | Social | Icon-only circles (FB, X, IG, LI) with hover effects + candidate signature |
| 14 | `atp_cand_footer` | Footer | Paid-for-by disclaimer, committee address, compliance page links, scroll progress JS, GSAP ScrollTrigger initialization |

### Animations (GSAP ScrollTrigger)

Every section has scroll-triggered animations:
- Hero: staggered entrance (label → title → intro → CTAs → photo)
- Stats: numbers fade up with 150ms stagger
- About: bio slides from left, credentials from right
- Messages/Issues/Endorsements/Volunteer: cards stagger in
- Video: scale-up entrance
- Social: icons pop in one by one

## Page 2: Issues & Answers

**Template:** Canvas
**Shortcodes:** `atp_cand_styles` + `atp_cand_nav` + `atp_cand_issues_page` + `atp_cand_footer`

Detailed policy positions page. One card per issue with:
- Navy header bar with issue title
- Red tag badge (e.g., "Roads & Infrastructure", "Fiscal Responsibility")
- Full position description paragraph(s)
- Direct candidate quotes where applicable

## Page 3: Donate

**Template:** Canvas
**Shortcodes:** `atp_cand_styles` + `atp_cand_nav` + `atp_cand_donate_page` + `atp_cand_footer`

- Dark navy hero header with "Donate to [Name]"
- Intro paragraph about supporting the campaign
- Embedded donation form iframe (Anedot, ActBlue, WinRed — whatever platform the candidate uses)
- Alternative donation info (mail-in check address)
- Legal disclaimer ("Contributions are not tax deductible")

## Page 4: Contact

**Template:** Canvas
**Shortcodes:** `atp_cand_styles` + `atp_cand_nav` + `atp_cand_contact` + `atp_cand_footer`

Two-column layout:
- Left: 5 contact cards with SVG icons (Phone, Email, Office Address, Schedule Meeting via Calendly, Social Media links)
- Right: Embedded Calendly scheduling iframe

## Page 5: Privacy Policy

**Template:** Canvas
**Shortcodes:** `atp_cand_styles` + `atp_cand_nav` + `atp_cand_privacy` + `atp_cand_footer`

13-section comprehensive policy. Variable fields in `[brackets]` auto-populated from `legal_compliance.*` during generation:
1. Introduction
2. Information We Collect (5 categories)
3. How We Collect Information
4. How We Use Information
5. Text Messaging (SMS/MMS) Privacy and 10DLC Disclosures
6. Cookies, Pixels, and Analytics
7. How We Share Information
8. Links to Other Websites
9. Data Retention
10. Security
11. Children's Privacy
12. Your Choices and Rights (state privacy laws)
13. Contact Us

## Page 6: Cookie, Tracking & SMS Compliance Policy

**Template:** Canvas
**Shortcodes:** `atp_cand_styles` + `atp_cand_nav` + `atp_cand_cookies` + `atp_cand_footer`

9-section policy. Same `[bracket]` variable system:
1. What Are Cookies
2. Types of Cookies (4 categories)
3. SMS/MMS TCPA and 10DLC Compliance
4. Third-Party Tools
5. Regional Consent Models (EU/UK opt-in, US opt-out)
6. How to Control Cookies
7. Relationship to Privacy Policy
8. Changes to Policy
9. Contact Us

## Page 7: Candidate Intake Form

**Template:** Canvas
**Shortcodes:** `atp_intake`

The 16-step intake form itself. This is an internal page — not visible to the public on client sites. On the ATP website, this is the main tool for ATP staff.
