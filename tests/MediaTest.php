<?php
/**
 * Тестирование работы с медиа материалами
 * @author Vitaly Serov
 */
class MediaTest extends TestCase {

    /**
     * Загрузка картинки
     */
    public function testLoadImage()
    {
        $product_model = \App\Models\ProductModel::first();

        if (!$product_model) {
            return;
        }

        $response = $this->call('POST', $this->getFullUrl('/seller/media/upload'),
            [
                'product_id' => $product_model->id,
                '_token' => csrf_token()
            ],
            [],
            [
                ''
            ]
        );
    }

}