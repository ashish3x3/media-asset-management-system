ddmedia
=======

**DDMedia** is a module for the [Yii PHP framework](http://www.yiiframework.com) that provides a web user interface to manage files and folders. 

Supported tasks so far:

* Browse folders
* Create new directory
* Upload a file
* Rename, copy, move, delete files or folders
* Preview for images
* Download for files

# Setup

Download the latest release from [Yii extensions](http://www.yiiframework.com/extension/ddmedia) or from [BitBucket](https://bitbucket.org/jwerner/yii-ddmedia).

Unzip the module under ***protected/modules/media*** and add the following to your application config:

~~~
[php]
return array(
    ...
    'modules'=>array(
        'media'=>array(
            // Base dir for media browser (app/files):
            'baseDir'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'files',
        ),
        ...
    ),
    ....
);
~~~
***protected/config/main.php***

Please note that the module doesn't require you to use a database.

# Usage

Add a link somewhere in your main menu like `CHtml::link('Media Browser', array('/ddmedia'))`.

# To Do's

* Show media meta data on clicking an item in a sidebar widget
* Add config option to hide/show hidden files or folders
