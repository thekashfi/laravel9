<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Emulating real sheets of paper in web documents (using HTML and CSS)">
    <title>Sheets of Paper</title>
    <style>
        html, body {
            /* Reset the document's margin values */
            margin: 0;
            /* Reset the document's padding values */
            padding: 0;
            /* Use the platform's native font as the default */
            font-family: "Roboto", -apple-system, "San Francisco", "Segoe UI", "Helvetica Neue", sans-serif;
            /* Define a reasonable base font size */
            font-size: 12pt;

            /* Styles for better appearance on screens only -- are reset to defaults in print styles later */

            /* Use a non-white background color to make the content areas stick out from the full page box */
            background-color: #eee;
        }
        /* Styles that are shared by all elements */
        * {
            /* Include the content box as well as padding and border for precise definitions */
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            /* Styles for better appearance on screens only -- are reset to defaults in print styles later */

            /* Divide single pages with some space and center all pages horizontally */
            margin: 1cm auto;
            /* Define a white paper background that sticks out from the darker overall background */
            background: #fff;
            /* Show a drop shadow beneath each page */
            box-shadow: 0 4px 5px rgba(75, 75, 75, 0.2);
            /* Override outline from user agent stylesheets */
            outline: 0;
        }
        /* Defines a class for manual page breaks via inserted .page-break element */
        div.page-break {
            page-break-after: always;
        }
        /* Simulates the behavior of manual page breaks from `print` mode in `screen` mode */
        @media screen {
            /* Renders the border and shadow at the bottom of the upper virtual page */
            div.page-break::before {
                content: "";
                display: block;
                /* Give a sufficient height to this element so that its drop shadow is properly rendered */
                height: 0.8cm;
                /* Offset the negative extra margin at the left of the non-pseudo element */
                margin-left: 0.5cm;
                /* Offset the negative extra margin at the right of the non-pseudo element */
                margin-right: 0.5cm;
                /* Make the bottom area appear as a part of the page margins of the upper virtual page */
                background-color: #fff;
                /* Show a drop shadow beneath the upper virtual page */
                box-shadow: 0 6px 5px rgba(75, 75, 75, 0.2);
            }
            /* Renders the empty space as a divider between the two virtual pages that are actually two parts of the same page */
            div.page-break {
                display: block;
                /* Assign the intended height plus the height of the pseudo element */
                height: 1.8cm;
                /* Apply a negative margin at the left to offset the page margins of the page plus some negative extra margin to paint over the border and shadow of the page */
                margin-left: -2.5cm;
                /* Apply a negative margin at the right to offset the page margins of the page plus some negative extra margin to paint over the border and shadow of the page */
                margin-right: -2.5cm;
                /* Create the bottom page margin on the upper virtual page (minus the height of the pseudo element) */
                margin-top: 1.2cm;
                /* Create the top page margin on the lower virtual page */
                margin-bottom: 2cm;
                /* Let this page appear as empty space between the virtual pages */
                background: #eee;
            }
        }
        /* For top-level headings only */
        h1 {
            /* Force page breaks after */
            page-break-before: always;
        }
        /* For all headings */
        h1, h2, h3, h4, h5, h6 {
            /* Avoid page breaks immediately */
            page-break-after: avoid;
        }
        /* For all paragraph tags */
        p {
            /* Reset the margin so that the text starts and ends at the expected marks */
            margin: 0;
        }
        /* For adjacent paragraph tags */
        p + p {
            /* Restore the spacing between the paragraphs */
            margin-top: 0.5cm;
        }
        /* For links in the document */
        a {
            /* Prevent colorization or decoration */
            text-decoration: none;
            color: black;
        }
        /* For tables in the document */
        table {
            /* Avoid page breaks inside */
            page-break-inside: avoid;
        }
        /* Use CSS Paged Media to switch from continuous documents to sheet-like documents with separate pages */
        @page {
            /* You can only change the size, margins, orphans, widows and page breaks here */

            /* Require that at least this many lines of a paragraph must be left at the bottom of a page */
            orphans: 4;
            /* Require that at least this many lines of a paragraph must be left at the top of a new page */
            widows: 2;
        }
        /* When the document is actually printed */
        @media print {
            html, body {
                /* Reset the document's background color */
                background-color: #fff;
            }
            .page {
                /* Reset all page styles that have been for better screen appearance only */
                /* Break cascading by using the !important rule */
                /* These resets are absolute must-haves for the print styles and the specificity may be higher elsewhere */
                width: initial !important;
                min-height: initial !important;
                margin: 0 !important;
                padding: 0 !important;
                border: initial !important;
                border-radius: initial !important;
                background: initial !important;
                box-shadow: initial !important;

                /* Force page breaks after each .page element of the document */
                page-break-after: always;
            }
        }
        .page {
            /* Styles for better appearance on screens only -- are reset to defaults in print styles later */

            /* Reflect the paper width in the screen rendering (must match size from @page rule) */
            width: 21cm;
            /* Reflect the paper height in the screen rendering (must match size from @page rule) */
            min-height: 29.7cm;

            /* Reflect the actual page margin/padding on paper in the screen rendering (must match margin from @page rule) */
            padding-left: 2cm;
            padding-top: 2cm;
            padding-right: 2cm;
            padding-bottom: 2cm;
        }
        /* Use CSS Paged Media to switch from continuous documents to sheet-like documents with separate pages */
        @page {
            /* You can only change the size, margins, orphans, widows and page breaks here */

            /* Paper size and page orientation */
            size: A4 portrait;

            /* Margin per single side of the page */
            margin-left: 2cm;
            margin-top: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

    </style>
</head>
<body>
<div class="document">
<div class="page" contenteditable="true">
    {!! $order->contract_text !!}
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
    <div>1</div>
</div>
</div>

<script type="text/javascript">
    // window.print();

    var Config = {};
    Config.pixelsPerInch = 96;
    Config.pageHeightInCentimeter = 29.7; // must match 'min-height' from 'css/sheets-of-paper-*.css' being used
    Config.pageMarginBottomInCentimeter = 2; // must match 'padding-bottom' and 'margin-bottom' from 'css/sheets-of-paper-*.css' being used

    window.addEventListener("DOMContentLoaded", function () {
        applyPageBreaks();
    });

    function applyPageBreaks() {
        applyManualPageBreaks();
        applyAutomaticPageBreaks(Config.pixelsPerInch, Config.pageHeightInCentimeter, Config.pageMarginBottomInCentimeter);

        document.querySelectorAll(".document .page").forEach(function (element) {
            if (!element.classList.contains("has-events")) {
                element.addEventListener("blur", function () {
                    applyPageBreaks();
                });

                element.classList.add("has-events");
            }
        });
    }

    /* Applies any manual page breaks in preview mode (screen, non-print) where CSS Paged Media is not fully supported */
    function applyManualPageBreaks() {
        var docs, pages, snippets;
        docs = document.querySelectorAll(".document");

        for (var d = docs.length - 1; d >= 0; d--) {
            pages = docs[d].querySelectorAll(".page");

            for (var p = pages.length - 1; p >= 0; p--) {
                snippets = pages[p].children;

                for (var s = snippets.length - 1; s >= 0; s--) {
                    if (snippets[s].classList.contains("page-break")) {
                        pages[p].insertAdjacentHTML("afterend", "<div class=\"page\" contenteditable=\"true\"></div>");

                        for (var n = snippets.length - 1; n > s; n--) {
                            pages[p].nextElementSibling.insertBefore(snippets[n], pages[p].nextElementSibling.firstChild);
                        }

                        snippets[s].remove();
                    }
                }
            }
        }
    }

    /* Applies (where necessary) automatic page breaks in preview mode (screen, non-print) where CSS Paged Media is not fully supported */
    function applyAutomaticPageBreaks(pixelsPerInch, pageHeightInCentimeter, pageMarginBottomInCentimeter) {
        var inchPerCentimeter = 0.393701;
        var pageHeightInInch = pageHeightInCentimeter * inchPerCentimeter;
        var pageHeightInPixels = Math.ceil(pageHeightInInch * pixelsPerInch);
        var pageMarginBottomInInch = pageMarginBottomInCentimeter * inchPerCentimeter;
        var pageMarginBottomInPixels = Math.ceil(pageMarginBottomInInch * pixelsPerInch);
        var docs, pages, snippets, pageCoords, snippetCoords;
        docs = document.querySelectorAll(".document");

        for (var d = docs.length - 1; d >= 0; d--) {
            pages = docs[d].querySelectorAll(".page");

            for (var p = 0; p < pages.length; p++) {
                if (pages[p].clientHeight > pageHeightInPixels) {
                    pages[p].insertAdjacentHTML("afterend", "<div class=\"page\" contenteditable=\"true\"></div>");
                    pageCoords = pages[p].getBoundingClientRect();
                    snippets = pages[p].querySelectorAll("h1, h2, h3, h4, h5, h6, p, div, span, ul, ol");

                    for (var s = snippets.length - 1; s >= 0; s--) {
                        snippetCoords = snippets[s].getBoundingClientRect();

                        if ((snippetCoords.bottom - pageCoords.top + pageMarginBottomInPixels) > pageHeightInPixels) {
                            pages[p].nextElementSibling.insertBefore(snippets[s], pages[p].nextElementSibling.firstChild);
                        }
                    }

                    pages = docs[d].querySelectorAll(".page");
                }
            }
        }
    }
</script>
</body>
</html>
