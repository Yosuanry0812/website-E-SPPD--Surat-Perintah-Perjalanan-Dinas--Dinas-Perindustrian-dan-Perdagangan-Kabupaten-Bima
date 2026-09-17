---
name: Civic Horizon
colors:
  surface: '#fbf8ff'
  surface-dim: '#dad9e3'
  surface-bright: '#fbf8ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f4f2fc'
  surface-container: '#eeedf7'
  surface-container-high: '#e8e7f1'
  surface-container-highest: '#e3e1eb'
  on-surface: '#1a1b22'
  on-surface-variant: '#444653'
  inverse-surface: '#2f3037'
  inverse-on-surface: '#f1f0fa'
  outline: '#757684'
  outline-variant: '#c4c5d5'
  surface-tint: '#3755c3'
  primary: '#00288e'
  on-primary: '#ffffff'
  primary-container: '#1e40af'
  on-primary-container: '#a8b8ff'
  inverse-primary: '#b8c4ff'
  secondary: '#006c49'
  on-secondary: '#ffffff'
  secondary-container: '#6cf8bb'
  on-secondary-container: '#00714d'
  tertiary: '#440098'
  on-tertiary: '#ffffff'
  tertiary-container: '#5f00d1'
  on-tertiary-container: '#c9aeff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dde1ff'
  primary-fixed-dim: '#b8c4ff'
  on-primary-fixed: '#001453'
  on-primary-fixed-variant: '#173bab'
  secondary-fixed: '#6ffbbe'
  secondary-fixed-dim: '#4edea3'
  on-secondary-fixed: '#002113'
  on-secondary-fixed-variant: '#005236'
  tertiary-fixed: '#eaddff'
  tertiary-fixed-dim: '#d2bbff'
  on-tertiary-fixed: '#25005a'
  on-tertiary-fixed-variant: '#5a00c6'
  background: '#fbf8ff'
  on-background: '#1a1b22'
  surface-variant: '#e3e1eb'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 36px
    fontWeight: '700'
    lineHeight: 44px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '600'
    lineHeight: 18px
    letterSpacing: 0.05em
  data-table:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
  headline-md-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  container-max: 1440px
  sidebar-width: 280px
  gutter: 24px
  margin-mobile: 16px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style

The design system is engineered for the administrative rigor of e-government services. The brand personality is authoritative yet accessible, focusing on clarity, trust, and structural integrity. 

The aesthetic follows a **Modern Corporate Minimalism** approach. It prioritizes data density without sacrificing legibility, utilizing expansive whitespace to separate complex information clusters. Visual hierarchy is established through precise alignment and a disciplined use of color, ensuring that government officials can navigate high-volume workflows with minimal cognitive load. The UI avoids unnecessary ornamentation, favoring functional clarity and a systematic layout that reflects the reliability of public institutions.

## Colors

The palette is anchored by **Deep Royal Blue**, chosen to evoke institutional credibility and stability. **Emerald Green** serves as the primary success indicator, reserved for financial totals and positive status updates. **Amber** is strictly utilized for corrective actions or "Edit" states to ensure they catch the user's eye without signaling a hard failure.

A specialized **Purple** (#7C3AED) is introduced specifically for "Luar Daerah" status markers to provide a distinct visual contrast from the primary blue used for "Dalam Daerah." The background uses a cool **Slate Grey** to reduce screen glare during extended administrative use, while pure white surfaces clearly demarcate interactive containers.

## Typography

This design system utilizes a dual-font strategy. **Plus Jakarta Sans** is used for headings to provide a modern, slightly softer professional edge. **Inter** is used for all functional body text, data tables, and form inputs due to its exceptional legibility in data-dense environments.

For data tables, use the `data-table` token which prioritizes a medium weight to ensure numerals are easily scannable. Labels use a slightly tracked-out uppercase style to distinguish them from user-generated content.

## Layout & Spacing

The system employs a **Fixed Grid** model for desktop, centered within a 1440px container. The primary navigation is a persistent left-hand sidebar (280px), allowing the main content area to breathe. 

In data-heavy views, a 12-column grid is used with 24px gutters. For statistical dashboards, content is grouped into cards that span 3 or 4 columns. On mobile devices, the sidebar collapses into a hamburger menu, and horizontal margins shrink to 16px. All vertical spacing between form elements and list items should follow an 8px incremental scale (stack-sm, stack-md, stack-lg).

## Elevation & Depth

This design system uses **Tonal Layering** combined with subtle shadows. The primary background is at the lowest level (Base). 

- **Level 1 (Cards/Tables):** Pure white surface with a `0px 1px 3px rgba(0,0,0,0.1)` shadow and a 1px border (#E2E8F0).
- **Level 2 (Popovers/Dropdowns):** Pure white surface with a more pronounced `0px 10px 15px -3px rgba(0,0,0,0.1)` shadow.

Interactions are indicated via subtle shifts in border color rather than heavy shadow changes, maintaining a "flat-plus" professional appearance.

## Shapes

The shape language is "Rounded," utilizing an **8px base radius** for standard components like input fields, buttons, and small cards. Large containers and main dashboard panels use a **12px radius** to create a softer, more modern enclosure. Status badges utilize a fully pill-shaped (999px) radius to distinguish them as non-interactive status indicators.

## Components

### Sidebar Navigation
The sidebar should feature a dark-themed or high-contrast light design. Active states are indicated by a 4px vertical "primary blue" bar on the left edge and a subtle background tint (#EFF6FF).

### Data Tables
Headers must be sticky with a subtle bottom border. Row hover states should use a very light tint (#F1F5F9). Action buttons within tables should be icon-only or small-text variants to save horizontal space.

### Form Fields
Inputs use a 1px Slate-200 border. On focus, the border transitions to Primary Blue (#1E40AF) with a 2px outer "halo" at 10% opacity. Labels are always positioned above the input.

### Status Badges
- **Dalam Daerah:** Blue background (10% opacity) with Navy text.
- **Luar Daerah:** Purple background (10% opacity) with Purple text.
- **Completed:** Green background (10% opacity) with Emerald text.

### Statistical Cards
Cards feature a large-format number (Plus Jakarta Sans Bold) with a small icon in the top right corner representing the data category (e.g., a "Map" icon for trips, "Wallet" for budget).

### Buttons
Primary buttons are solid Navy (#1E40AF) with white text. Secondary buttons for "Edit" or "Repair" actions use the Amber (#F59E0B) color in an outlined or ghost style to indicate their secondary nature compared to "Submit" or "Approve."