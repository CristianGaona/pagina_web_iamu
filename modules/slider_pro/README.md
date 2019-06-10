The Slider Pro module integrates the jQuery Slider Pro plugin with Drupal.
Slider Pro is a modular, responsive and touch-enabled jQuery slider plugin 
that enables you to create elegant and professionally looking sliders. 
This module integrates with the Views module.

## Installation

### Using Composer

 * Edit your project's `composer.json` file and add to the repositories section:
   ```
   "bqworks/slider-pro": {
       "type": "package",
       "package": {
           "name": "bqworks/slider-pro",
           "type": "drupal-library",
           "version": "1.2.2",
           "dist": {
               "url": "https://github.com/bqworks/slider-pro/archive/1.2.2.zip",
               "type": "zip"
           }
       }
   }
   ```
 * Execute `composer require drupal/slider_pro`.

### Manually

 * Download the [Slider Pro plugin](https://github.com/bqworks/slider-pro)
   and place the resulting directory into the libraries directory. Ensure
   `libraries/slider-pro/dist/js/jquery.sliderPro.min.js` exists.
 * Download the Slider Pro module and follow the instruction for
   [installing contributed modules](https://www.drupal.org/docs/8/extending-drupal-8/installing-contributed-modules-find-import-enable-configure-drupal-8).

## Usage

### Views

 1. Create a new Slider Pro optionset or use the default one (admin/config/media/slider-pro)
 2. When creating a view, select the *Slider Pro* format.
 3. Click on the *Settings* link, under the **Format** section.
 4. Fill out the settings and apply them to your display.

### Field Formatter

 1. Create an image field.
 2. Choose the *Slider Pro* format.
 3. Configure Slider Pro format settings