<div class="your-package" id="your-package">
    <h3>Выберите свой пакет</h3>
    <div class="container">
        <h4>
            Только <span class="tomorrow"></span><br/>закажите продающий лендинг <br/>и получите в подарок <span
                class="multi">МУЛЬТИЛЕНДИНГ!!!</span>
        </h4>
        <div class="row list-package">
            <?php if($services) : ?>
                <?php foreach($services as $service) : ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="wp-package">
                            <div class="top-package">
                                <h4><?= $service->name ?></h4>
                                <div class="price-package"><?= number_format($service->price, 0, '', ' ') ?> р.</div>
                                <div class="old-price-package"><?= number_format($service->old_price, 0, '', ' ') ?></div>
                            </div>
                            <div class="prev-package">
                                <?= $service->description ?>
                            </div>
                            <div class="go-package">
                                <a onclick="showPopup('Пакет', '<?= $service->id ?>');" class="button-slty package-go" title-package="<?= $service->name ?>">Выбрать</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
