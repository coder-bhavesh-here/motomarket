<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>World On Moto</title>
    <wireui:scripts />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        :host,
        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-feature-settings: normal;
            font-variation-settings: normal;
            -webkit-tap-highlight-color: transparent
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-feature-settings: normal;
            font-variation-settings: normal;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-feature-settings: inherit;
            font-variation-settings: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        dialog {
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img:not(.favourite img, .success img),
        video:not(.favourite video) {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .absolute {
            position: absolute
        }

        .relative {
            position: relative
        }

        .-left-20 {
            left: -5rem
        }

        .top-0 {
            top: 0px
        }

        .-bottom-16 {
            bottom: -4rem
        }

        .-left-16 {
            left: -4rem
        }

        .-mx-3 {
            margin-left: -0.75rem;
            margin-right: -0.75rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .aspect-video {
            aspect-ratio: 16 / 9
        }

        .size-12 {
            width: 3rem;
            height: 3rem
        }

        .size-5 {
            width: 1.25rem;
            height: 1.25rem
        }

        .size-6 {
            width: 1.5rem;
            height: 1.5rem
        }

        .h-12 {
            height: 3rem
        }

        .h-40 {
            height: 10rem
        }

        .h-full {
            height: 100%
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-full {
            width: 100%
        }

        .w-\[calc\(100\%\+8rem\)\] {
            width: calc(100% + 8rem)
        }

        .w-auto {
            width: auto
        }

        .max-w-\[877px\] {
            max-width: 877px
        }

        .max-w-2xl {
            max-width: 42rem
        }

        .flex-1 {
            flex: 1 1 0%
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .flex-col {
            flex-direction: column
        }

        .items-start {
            align-items: flex-start
        }

        .items-center {
            align-items: center
        }

        .items-stretch {
            align-items: stretch
        }

        .justify-end {
            justify-content: flex-end
        }

        .justify-center {
            justify-content: center
        }

        .gap-2 {
            gap: 0.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .gap-6 {
            gap: 1.5rem
        }

        .self-center {
            align-self: center
        }

        .overflow-hidden {
            overflow: hidden
        }

        .rounded-\[10px\] {
            border-radius: 10px
        }

        .rounded-full {
            border-radius: 9999px
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-md {
            border-radius: 0.375rem
        }

        .rounded-sm {
            border-radius: 0.125rem
        }

        .bg-\[\#FF2D20\]\/10 {
            background-color: rgb(255 45 32 / 0.1)
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-gradient-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
        }

        .from-transparent {
            --tw-gradient-from: transparent var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-white {
            --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
        }

        .to-white {
            --tw-gradient-to: #fff var(--tw-gradient-to-position)
        }

        .stroke-\[\#FF2D20\] {
            stroke: #FF2D20
        }

        .object-cover {
            object-fit: cover
        }

        .object-top {
            object-position: top
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem
        }

        .pt-3 {
            padding-top: 0.75rem
        }

        .text-center {
            text-align: center
        }

        .font-sans {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .text-sm\/relaxed {
            font-size: 0.875rem;
            line-height: 1.625
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .font-semibold {
            font-weight: 600
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\] {
            --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
            --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .ring-transparent {
            --tw-ring-color: transparent
        }

        .ring-white\/\[0\.05\] {
            --tw-ring-color: rgb(255 255 255 / 0.05)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .transition {
            transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .duration-300 {
            transition-duration: 300ms
        }

        .selection\:bg-\[\#FF2D20\] *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-\[\#FF2D20\]::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-black:hover {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .hover\:text-black\/70:hover {
            color: rgb(0 0 0 / 0.7)
        }

        .hover\:ring-black\/20:hover {
            --tw-ring-color: rgb(0 0 0 / 0.2)
        }

        .focus\:outline-none:focus {
            outline: 2px solid transparent;
            outline-offset: 2px
        }

        .focus-visible\:ring-1:focus-visible {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
        }

        @media (min-width: 640px) {
            .sm\:size-16 {
                width: 4rem;
                height: 4rem
            }

            .sm\:size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .sm\:pt-5 {
                padding-top: 1.25rem
            }
        }

        @media (min-width: 768px) {
            .md\:row-span-3 {
                grid-row: span 3 / span 3
            }
        }

        @media (min-width: 1024px) {
            .lg\:col-start-2 {
                grid-column-start: 2
            }

            .lg\:h-16 {
                height: 4rem
            }

            .lg\:max-w-7xl {
                max-width: 80rem
            }

            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .lg\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .lg\:flex-col {
                flex-direction: column
            }

            .lg\:items-end {
                align-items: flex-end
            }

            .lg\:justify-center {
                justify-content: center
            }

            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-10 {
                padding: 2.5rem
            }

            .lg\:pb-10 {
                padding-bottom: 2.5rem
            }

            .lg\:pt-0 {
                padding-top: 0px
            }

            .lg\:text-\[\#FF2D20\] {
                --tw-text-opacity: 1;
                color: rgb(255 45 32 / var(--tw-text-opacity))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:block {
                display: block
            }

            .dark\:hidden {
                display: none
            }

            .dark\:bg-black {
                --tw-bg-opacity: 1;
                background-color: rgb(0 0 0 / var(--tw-bg-opacity))
            }

            .dark\:bg-zinc-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(24 24 27 / var(--tw-bg-opacity))
            }

            .dark\:via-zinc-900 {
                --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .dark\:to-zinc-900 {
                --tw-gradient-to: #18181b var(--tw-gradient-to-position)
            }

            .dark\:text-white\/50 {
                color: rgb(255 255 255 / 0.5)
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:text-white\/70 {
                color: rgb(255 255 255 / 0.7)
            }

            .dark\:ring-zinc-800 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity))
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:hover\:text-white\/70:hover {
                color: rgb(255 255 255 / 0.7)
            }

            .dark\:hover\:text-white\/80:hover {
                color: rgb(255 255 255 / 0.8)
            }

            .dark\:hover\:ring-zinc-700:hover {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity))
            }

            .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity))
            }

            .dark\:focus-visible\:ring-white:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity))
            }
        }

        .slide-left {
            transform: translateX(0) !important;
        }

        .slide-down {
            transform: translateX(100%) !important;
        }

        /* Optional: Add smooth scrolling to the popup content */
        #fullScreenPopup {
            -webkit-overflow-scrolling: touch;
            z-index: 1001 !important;
        }

        /* Optional: Hide scrollbar when not scrolling */
        #fullScreenPopup::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="antialiased dark:bg-black dark:text-white/50 bg-[#f9fafb]">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Global Image Preview Modal -->
    <div id="globalImageModal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-85 hidden">
        <div class="relative">
            <button onclick="closeGlobalImageModal()" class="absolute top-2 right-2 text-white text-3xl font-bold" style="border: unset !important;">
                &times;
            </button>
            <img id="globalModalImage" src="" class="max-w-screen-lg max-h-screen rounded shadow-lg" />
        </div>
    </div>
    <div id="loading" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center">
        <img src="/images/loader.gif" alt="Loading..." class="w-16 h-16">
    </div>
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50" style="max-width: 1920px; width: 100%; margin: 0 auto;">
        <div class="relative min-h-screen flex flex-col selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full">
                <header class="grid grid-cols-2 items-center gap-2 wommd:grid-cols-3 pt-2 px-4">
                    <a href="{{ route('homepage') }}">
                        <div class="flex items-center lg:justify-start lg:col-start-1">
                            <img class="womsm:w-2/4 wommd:w-2/4 ml-2" src="{{ asset('images/management-logo.png') }}"
                                alt="Logo">
                        </div>
                    </a>
                    <div class="hidden wommd:block lg:justify-center lg:col-start-2">
                        {{-- <div class="hidden wommd:block lg:justify-center lg:col-start-2" style="
                            background: red;
                            color: white;
                            font-size: xx-large;
                            text-align: center;
                        ">
                        DEMO SITE <br> UNDER TESTING

                                            </div> --}}
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 hidden womsm:flex flex-1 items-center justify-end mr-8">
                            @auth
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-bold text-xs wommd:text-base rounded-md womsm:max-wommd:p-2 px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Sign in
                                </a>

                                <a href="{{ route('register') }}"
                                    class="font-bold text-xs wommd:text-base rounded-md womsm:max-wommd:p-2 px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Sign up
                                </a>
                            @endauth
                            @auth
                                @php
                                    $incompleteCount = \App\Models\IncompleteBooking::where('user_id', auth()->id())->distinct('tour_id')->count();
                                @endphp
                                <a class="relative inline-block icon-box ml-4" href="/my-incomplete-tours">
                                    <img src="{{ asset('images/motorcycle.svg') }}" alt="Bike">
                                    @if($incompleteCount > 0)
                                        <span style="background: red;" class="absolute -top-2 -right-2 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
                                            {{ $incompleteCount }}
                                        </span>
                                    @endif
                                </a>
                                <span class="relative inline-block icon-box ml-4">
                                    @php
                                        $favouriteCount = auth()->user()->favouriteTours->count();
                                    @endphp
                                    <a href="/my-favourite-tours">
                                        <svg style="margin-left: 7px; margin-top: 3px;" width="24" height="22"
                                            viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.0794 2.96982C20.5362 2.4247 19.8907 1.99217 19.1799 1.69705C18.4692 1.40192 17.7071 1.25 16.9376 1.25C16.168 1.25 15.4059 1.40192 14.6952 1.69705C13.9844 1.99217 13.3389 2.4247 12.7957 2.96982L11.9619 3.81444L11.1281 2.96982C10.5849 2.4247 9.9394 1.99217 9.22865 1.69705C8.51789 1.40192 7.75587 1.25 6.98629 1.25C6.2167 1.25 5.45468 1.40192 4.74392 1.69705C4.03317 1.99217 3.38767 2.4247 2.84443 2.96982C0.548821 5.26544 0.408053 9.14199 3.29923 12.0873L11.9619 20.75L20.6246 12.0873C23.5158 9.14199 23.375 5.26544 21.0794 2.96982Z"
                                                stroke="#D1E7AB" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        @if($favouriteCount > 0)
                                            <span style="background: red;" class="absolute -top-2 -right-2 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
                                                {{ $favouriteCount }}
                                            </span>
                                        @endif
                                    </a>
                                </span>
                            @endauth
                            <span class="ml-4">
                                @auth
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <a href="{{ url('/profiles') }}">
                                    @endauth
                                    @if (isset($user) && $user != null && $user->profile_picture)
                                        <img id="profile-picture-img" style="height: 47px; width: 47px;"
                                            src="{{ asset('storage/' . $user->profile_picture) }}"
                                            alt="Profile Picture" class="rounded-full">
                                    @else
                                        <a href="/profiles"><img src="{{ asset('images/user.png') }}" alt=""></a>
                                    @endif
                                    @auth
                                    </a>
                                @endauth
                            </span>
                        </nav>
                        <img class="block womsm:hidden justify-self-end" onclick="openPopup()"
                            src="{{ asset('images/menu.png') }}" alt="Menu">
                    @endif
                </header>

                <!-- Add this right after your existing header section -->
                <div id="fullScreenPopup"
                    class="fixed womsm:hidden inset-0 transform translate-x-full transition-transform duration-300 ease-in-out bg-[#EEEEEE]">
                    <div class="relative w-full h-full py-14 px-4">
                        <!-- Close button -->
                        <button onclick="closePopup()" style="border: unset !important"
                            class="absolute bottom-20 left-1/2 z-50">
                            <svg width="32" height="31" viewBox="0 0 32 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.56836 1.4082L30.6327 29.4725" stroke="black" stroke-width="2"
                                    stroke-linecap="round" />
                                <path d="M29.6973 1.4082L1.63293 29.4725" stroke="black" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </button>

                        <!-- Content container -->
                        <div class="text-center font-semibold text-base text-black h-full overflow-y-auto p-8">
                            WorldonMoto.com
                            @auth
                                <div class="grid grid-cols-1 mt-[15%] justify-evenly h-[40%]">
                                    <div class="inline-flex justify-self-center items-center">
                                        <span class="icon-box ml-4 justify-self-end mr-2">
                                            <img src="{{ asset('images/motorcycle.svg') }}" alt="Bike">
                                        </span>
                                        <span class="justify-self-start ml-2">Open Tours</span>
                                    </div>
                                    <a class="inline-flex justify-self-center items-center" href="/my-favourite-tours">
                                        <span class="icon-box ml-4 justify-self-end mr-2">
                                            <svg style="margin-left: 7px; margin-top: 3px;" width="24" height="22"
                                                viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.0794 2.96982C20.5362 2.4247 19.8907 1.99217 19.1799 1.69705C18.4692 1.40192 17.7071 1.25 16.9376 1.25C16.168 1.25 15.4059 1.40192 14.6952 1.69705C13.9844 1.99217 13.3389 2.4247 12.7957 2.96982L11.9619 3.81444L11.1281 2.96982C10.5849 2.4247 9.9394 1.99217 9.22865 1.69705C8.51789 1.40192 7.75587 1.25 6.98629 1.25C6.2167 1.25 5.45468 1.40192 4.74392 1.69705C4.03317 1.99217 3.38767 2.4247 2.84443 2.96982C0.548821 5.26544 0.408053 9.14199 3.29923 12.0873L11.9619 20.75L20.6246 12.0873C23.5158 9.14199 23.375 5.26544 21.0794 2.96982Z"
                                                    stroke="#D1E7AB" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                        <span class="justify-self-start ml-2">Favourite Tours</span>
                                    </a>
                                    <a href="{{ url('/profiles') }}" class="inline-flex justify-self-center items-center">
                                        @auth
                                            <span
                                                class="{{ $user && $user != null && $user->profile_picture ? '' : 'icon-box' }} ml-4 justify-self-end mr-2">
                                        @endauth
                                        @if ($user && $user != null && $user->profile_picture)
                                            <img id="profile-picture-img" style="height: 47px; width: 47px;"
                                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                                alt="Profile Picture" class="rounded-full">
                                        @else
                                                <img src="{{ asset('images/user.png') }}" alt="">
                                        @endif
                                        @auth
                                        </span>
                                            <span class="justify-self-start ml-2">My Profile</span>
                                        @endauth
                                    </a>
                                </div>
                            @else
                                <div class="bg-white p-4 text-sm font-bold mt-10 mb-4">
                                    <a style="color: black; text-decoration: none;" href="{{ route('login') }}">Sign
                                        in</a>
                                </div>
                                <div class="bg-white p-4 text-sm font-bold">
                                    <a style="color: black; text-decoration: none;" href="{{ route('register') }}">Sign
                                        up</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                <script>
                    function openPopup() {
                        const popup = document.getElementById('fullScreenPopup');
                        popup.classList.add('slide-left');
                        document.body.style.overflow = 'hidden';
                    }

                    function closePopup() {
                        const popup = document.getElementById('fullScreenPopup');
                        popup.classList.remove('slide-left');
                        document.body.style.overflow = '';
                    }
                </script>
