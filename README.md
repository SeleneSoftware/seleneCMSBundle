# SeleneCMS Bundle
This is a bundle for the [Symfony](https://www.symfony.com) Web Framework.  As such, installing requires a few needed steps.  First, have an updated version of the [Composer Package Manager](https://www.getcomposer.org/installation) installed on your system.

## Installation
This bundle enables CMS functionality on a Symfony site.  This requires a few instalation steps, hopefully the Symfony Flex took care of them, but here are the steps.

If you are using Symfony Flex, as you should be, just run this composer command in your project:
```bash composer require selene/cms-bundle```
The Recipe will install the necessary Controllers and configurations so that you can just get started.

If you aren't using Flex, you will need to add the following line:
```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Selene\CMSBundle\seleneCMSBundle(),

        ];

        // ...

    }

}
```
Then you will need several controllers that extend the controllers in the bundle:
```php
BlogController extends Selene\CMSBundle\Controller\BlogController
SecurityController extends Selene\CMSBundle\Controller\SecurityController
RegistrationController extends Selene\CMSBundle\Controller\RegistrationController
AdminDashboardController extends Selene\CMSBundle\Controller\Admin\DashboardController
AdminContentController extends Selene\CMSBundle\Controller\Admin\ContentCrudController
AdminBlogController extends Selene\CMSBundle\Controller\Admin\BlogCrudController
AdminUsersController extends Selene\CMSBundle\Controller\Admin\UserCrudController
AdminSettingsController extends Selene\CMSBundle\Controller\Admin\SettingCrudController
```


You will need to create a few templates for your new site.
```bash
templates/blog/index.html.twig
templates/security/login.html.twig
templates/registration/register.html.twig
templates/confirmation_email.html.twig
```

Once the bundle is installed, run whatever you need for your database.

This will install the following routes in your application:
/blog
/blog/{entry}
/register
/login
/admin

## Usage

Content is managed in the backend when a Twig extension is used.  The name of the block will appear in the admin panel on first load and give the ability to change the data inside the tag.  To create a content block with the title "selene", use the following tag.
```Twig
{% apply selene_content %}<div class="block">This is the default content in the block</div>{% endapply%}
```

This also installs settings, which are true/false or on/off.  To use one of those, use the following tag:
```Twig
{% if getSetting('Search') %}<div class="search"><input type="text"></div>{% endif %}
```

Settings by default are false, so the first time that is loaded on the site, the stuff in between will not show.

The wonderful thing about content and setting tags is the default setting.  You don't have to create them in the admin panel to create one.  Just program it in your Twig template and it will appear on your admin panel the first time it is rendered.  From there, you can change them however you want.  And if you need to use the same content in different places, you can do just that.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
When creating a new feature branch, run a ```composer update````` and a  `````npm update````` and commit those changes first.

## License
[MIT](https://choosealicense.com/licenses/mit/) ````
````
````
