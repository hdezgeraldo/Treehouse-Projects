const $odd = $('a:odd');

const $secureLinks = $('a[href^="https://"]');

const $pdfs = $('a[href$="pdf"');

$secureLinks.attr('target', '_blank');

// Adding download attribe to PDF links
$pdfs.attr('download', true);

// Adding classes to existing HTML tags
$secureLinks.addClass('secure');
$pdfs.addClass('pdf');