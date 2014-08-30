CImageModifier
==============

Implements class.upload into Yii framework.

Class.Upload written by Colin VEROT ([http://www.verot.net/](http://www.verot.net/))

This PHP script uploads and manipulates images very easily. The perfect script to generate thumbnails or create a photo gallery! It can convert, resize and work on uploaded images in many ways, apply effects, add labels, watermarks and reflections and other image editing features. You can use it for files uploaded through an HTML form, a Flash uploader, or on local files. It uses the GD library. This script is released under the GPL Version 2. If your project is not GPL, commercial licenses are available.

##Requirements

GD library

##Usage
1. unpack extension into desired location 
2. connect CImageModifier extension:

**connection way 1:**
In your config.php file, in the components section, add the following:
~~~
[php]
'imagemod' => array(
               //alias to dir, where you unpacked extension
    'class' => 'application.extensions.imagemodifier.CImageModifier',
),
~~~
**connection way 2:**
in your code:
~~~
[php]
Yii::app()->setComponents(array('imagemod'=>array('class'=>'application.extensions.imagemodifier.CImageModifier')));
~~~

3. Main usage 
for uploaded image:
~~~
[php]
$img = Yii::app()->imagemod->load($_FILES['form_field']);
if ($img->uploaded) {
    $img->image_resize          = true;
    $img->image_ratio_y         = true;
    $img->image_x               = 50;
    $img->file_new_name_body = md5($img->file_src_name);
    $img->process('/home/images');
    if ($img->processed) {
      echo 'image resized';
      $img->clean();
    } else {
      echo 'error : ' . $img->error;
    }
}

~~~
or for static image:
~~~
[php]
$img = Yii::app()->imagemod->load('path/to/image');
$img->image_resize          = true;
$img->image_ratio_y         = true;
$img->image_x               = 50;
$img->file_new_name_body = md5($img->file_src_name);
$img->process('/home/images');
if ($img->processed) {
    echo 'image resized';
    $img->clean();
} else {
    echo 'error : ' . $img->error;
}
~~~

##Methods
#### setLanguage($string)
By default this extension uses language set in **config.php** of your project. But you can change it using
~~~
[php]
Yii::app()->imagemod->setLanguage('ru_RU');
~~~
You can see al supported languages in extension `/lang` dir.

##Features
 * Multilingual
 * Big [code samples library](http://www.verot.net/php_class_upload_samples.htm)
 * Good documentation
 * Working with uploaded and static images
 * Will work in any desired unpack dir without rewriting aliases in import functions

##Resources

 * [Class official site](http://www.verot.net/php_class_upload.htm)
 * [Code samples](http://www.verot.net/php_class_upload_samples.htm)
 * [Documentation](http://www.verot.net/res/sources/class.upload.html)
 * [FAQ](http://www.verot.net/php_class_upload_faq.htm)
