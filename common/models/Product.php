<?php

namespace common\models;


use yii\web\NotFoundHttpException;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property float $cost
 * @property string $description
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    public $image;
    public $gallery;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'cost', 'description'], 'required'],
            [['category_id'], 'integer'],
            [['cost'], 'number'],
            [['name', 'description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'name' => 'Наименование',
            'cost' => 'Цена',
            'description' => 'Описание',
            'image' => 'Главное фото галерии',
            'gallery' => 'Загрузить не более 5 фотографий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return (isset($this->category)) ? $this->category->title : ' не задан';
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $path = Yii::getAlias('@webroot/upload/files') . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function uploadGallery()
    { // сохраняет целиком галерею
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $path = Yii::getAlias('@webroot/upload/files') . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Возвращает список товаров в указанной категории
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getProductsListByCategory($id)
    {
        return Product::Find()->where(['category_id' => $id])->orderBy('id')->all();
    }

    /**
     * @brief Возвращает продукт с указанным id
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function getProductById($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
