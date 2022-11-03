<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{ route('aboutus') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc>{{ route('connectus') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
    </url>
     @foreach($categories as $category)
        <url>
            <loc>{{ route('category', $category->slug) }}</loc>
            <changefreq>monthly</changefreq>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
        @if($category->packages_count > 0)
            <url>
                <loc>{{ route('packages', $category->slug) }}</loc>
                <changefreq>monthly</changefreq>
                <priority>0.9</priority>
            </url>
        @endif
        @if($category->contracts_count > 0)
            <url>
                <loc>{{ route('contracts', $category->slug) }}</loc>
                <changefreq>monthly</changefreq>
                <priority>0.9</priority>
            </url>
        @endif
        @if($category->files_count > 0)
            <url>
                <loc>{{ route('contracts', $category->slug) }}</loc>
                <changefreq>monthly</changefreq>
                <priority>0.9</priority>
            </url>
        @endif
    @endforeach
    @foreach($contracts as $contract)
        <url>
            <loc>{{ route('contract', $contract->slug) }}</loc>
            <changefreq>monthly</changefreq>
            <lastmod>{{ $contract->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach($files as $file)
        <url>
            <loc>{{ route('file', $file->slug) }}</loc>
            <changefreq>monthly</changefreq>
            <lastmod>{{ $file->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach($packages as $package)
        <url>
            <loc>{{ route('package', $package->slug) }}</loc>
            <changefreq>monthly</changefreq>
            <lastmod>{{ $package->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
