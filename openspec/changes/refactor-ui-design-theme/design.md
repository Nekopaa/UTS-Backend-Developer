# Design Specification: UI Design Theme Overhaul

This document defines the visual design system tokens and component class definitions for shifting the application from the Neobrutalism theme to a premium **Soft Glassmorphic & SaaS Modern** theme.

## 1. Visual Style Tokens

### Backgrounds & Layout
- **Theme Color Palette**: Soft slate-cool tones paired with vibrant gradient accents (Indigo, Amber, Rose, Emerald).
- **Main Background**: Replace flat `#F4F2EC` cream with a premium, ambient gradient mesh background:
  - Tailwind: `bg-gradient-to-br from-slate-50 via-slate-100 to-indigo-50/30 min-h-screen`
  - CSS variable: `--bg-gradient`
- **Sidebar**: Clean white frosted background with soft right border:
  - Classes: `bg-white/95 backdrop-blur-md border-r border-slate-200/80`

### 2. Component Class Definitions

#### Glassmorphic Cards (`.premium-card` / `.neo-brutal-card`)
Instead of `border: 3px solid #000000` and `box-shadow: 6px 6px 0px #000000`, cards will use borderless soft-glass styling:
- **Background**: Translucent white with backdrop blur:
  - CSS: `background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);`
- **Border**: Very subtle low-opacity border:
  - CSS: `border: 1px solid rgba(226, 232, 240, 0.8);`
- **Shadow**: Deep, multi-layered ambient soft shadow simulating light diffusion:
  - CSS: `box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03), 0 4px 12px -2px rgba(0, 0, 0, 0.02);`
- **Transitions**: Smooth scaling and shadow expansions:
  - Classes: `transition-all duration-300 hover:translate-y-[-2px] hover:shadow-2xl hover:shadow-slate-200/50`

#### SaaS Modern Buttons (`.premium-btn` / `.neo-brutal-btn`)
Replace the thick-bordered flat-shadow buttons with rounded, gradient-accented premium buttons:
- **Base Button**: `rounded-xl font-bold transition-all duration-200 inline-flex items-center justify-center cursor-pointer px-4 py-2.5 text-xs tracking-wide border-0`
- **Interactive State**: `hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-4`
- **Primary / Add / Edit Button (Amber/Gold)**:
  - CSS: `background: linear-gradient(135deg, #facc15 0%, #f59e0b 100%); color: #000000;`
  - Focus Ring: `focus:ring-amber-200`
- **Success / Save Button (Emerald/Teal)**:
  - CSS: `background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff;`
  - Focus Ring: `focus:ring-emerald-200`
- **Danger / Delete Button (Rose/Red)**:
  - CSS: `background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); color: #ffffff;`
  - Focus Ring: `focus:ring-rose-200`
- **Info / Detail Button (Cyan/Blue)**:
  - CSS: `background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: #ffffff;`
  - Focus Ring: `focus:ring-cyan-200`

#### Sleek Input Fields (`.premium-input` / `.neo-brutal-input`)
Replace thick black input borders with elegant slate borders:
- **Base Input**:
  - CSS: `background: rgba(248, 250, 252, 0.6); border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 14px; outline: none; font-size: 0.9rem; font-weight: 600; color: #1e293b; transition: all 0.2s ease;`
- **Focus / Active State**:
  - CSS: `background: #ffffff; border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);`

#### Elegant Badges (`.premium-badge` / `.neo-brutal-badge`)
Replace thick solid badges with soft rounded pills:
- **Base Badge**: `inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border-0`
- **Success (Aktif/Tiba/Selesai)**: `bg-emerald-50 text-emerald-700`
- **Warning (Menunggu/Proses)**: `bg-amber-50 text-amber-700`
- **Danger (Nonaktif/Gagal/Batal)**: `bg-rose-50 text-rose-700`
- **Primary (Jalan/Lembaga)**: `bg-indigo-50 text-indigo-700`
