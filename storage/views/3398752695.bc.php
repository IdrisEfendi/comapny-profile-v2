<?php 
    $settings = isset($siteSettings) ? $siteSettings : public_settings();
?>

<footer class="border-t border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 py-12 md:grid-cols-4">
        <div class="md:col-span-2">
            <div class="flex items-center gap-3">
                <?php if (! empty($settings['logo_path'])): ?>
                    <img src="<?php echo e(asset($settings['logo_path'])) ?>" alt="Logo <?php echo e($settings['company_name']) ?>" class="h-11 w-11 rounded-2xl bg-white object-contain p-1 shadow-sm">
                <?php else: ?>
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-700 text-sm font-bold text-white">BPR</span>
                <?php endif; ?>
                <div>
                    <p class="font-bold text-slate-950"><?php echo e($settings['company_name']) ?></p>
                    <p class="text-sm text-slate-500"><?php echo e($settings['tagline']) ?></p>
                </div>
            </div>
            <p class="mt-5 max-w-xl text-sm leading-6 text-slate-600">
                Media informasi digital untuk memperkenalkan profil, produk, pengurus, dan kanal kontak <?php echo e($settings['company_name']) ?> secara jelas dan mudah diakses.
            </p>
        </div>

        <div>
            <h3 class="font-semibold text-slate-950">Menu</h3>
            <ul class="mt-4 space-y-2 text-sm text-slate-600">
                <li><a class="hover:text-blue-700" href="<?php echo e(url('tentang-kami')) ?>">Tentang Kami</a></li>
                <li><a class="hover:text-blue-700" href="<?php echo e(url('produk-layanan')) ?>">Produk & Layanan</a></li>
                <li><a class="hover:text-blue-700" href="<?php echo e(url('pengurus')) ?>">Pengurus</a></li>
                <li><a class="hover:text-blue-700" href="<?php echo e(url('berita')) ?>">Berita</a></li>
                <li><a class="hover:text-blue-700" href="<?php echo e(url('kontak')) ?>">Kontak</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-semibold text-slate-950">Kontak</h3>
            <ul class="mt-4 space-y-2 text-sm leading-6 text-slate-600">
                <li><?php echo e($settings['address']) ?></li>
                <li><?php echo e($settings['phone']) ?></li>
                <li><?php echo e($settings['email']) ?></li>
                <li><?php echo e($settings['office_hours']) ?></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-slate-200 py-5">
        <p class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-sm text-slate-500">© <?php echo e(date('Y')) ?> <?php echo e($settings['company_name']) ?>. All rights reserved.</p>
    </div>
</footer>
