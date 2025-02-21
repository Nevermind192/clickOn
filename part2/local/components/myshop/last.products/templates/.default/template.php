<?php if (!empty($arResult['PRODUCTS'])): ?>
    <div class="product-list">
        <?php foreach ($arResult['PRODUCTS'] as $product): ?>
            <div class="product-card">
                <img src="<?= $product['DETAIL_PICTURE'] ?>" alt="<?= $product['NAME'] ?>" class="product-image" />
                <div class="product-info">
                    <h3 class="product-title"><?= htmlspecialchars($product['NAME']) ?></h3>
                    <p class="product-price"><strong>Цена:</strong> <?= number_format($product['PRICE'], 0, '.', ' ') ?> руб.</p>
                    <button class="btn-buy">Купить</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Товары не найдены.</p>
<?php endif; ?>
