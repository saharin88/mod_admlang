<?php

defined('_JEXEC') or die;

use Joomla\CMS\
{
	Factory,
	Language\LanguageHelper,
	HTML\HTMLHelper
};

HTMLHelper::_('form.csrf');

$cur_lang_code = Factory::getLanguage()->getTag();
$languages     = LanguageHelper::getLanguages('lang_code');

if (count($languages) > 1 && isset($languages[$cur_lang_code]))
{
	?>
    <div class="mod_admlang <?= $params->get('moduleclass_sfx') ?>">

        <ul class="nav nav-user">

            <li class="deopdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<?= HTMLHelper::_('image', 'mod_languages/' . $languages[$cur_lang_code]->image . '.gif', $languages[$cur_lang_code]->sef, ['title' => $languages[$cur_lang_code]->title], true) ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
					<?php
					unset($languages[$cur_lang_code]);
					foreach ($languages AS $language)
					{
						?>
                        <li>
                            <a data-lang="<?= $language->lang_code ?>" href="#">
								<?php
								if (!empty($language->image))
								{
									echo HTMLHelper::_('image', 'mod_languages/' . $language->image . '.gif', $language->sef, ['title' => $language->title], true);
								}
								?>
								<?= $language->title ?>
                            </a>
                        </li>
						<?php
					}
					?>
                </ul>
            </li>


        </ul>

    </div>

    <script>
        jQuery(document).ready(function ($) {

            $('a[data-lang]').on('click', function (e) {
                e.preventDefault();
                var lang = $(this).data('lang');
                $.ajax({
                    url: "//" + location.host + "/administrator/index.php?option=com_ajax&module=admlang&method=change&format=json&" + Joomla.getOptions('csrf.token') + "=1",
                    data: {lang: lang},
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Request Error');
                    }
                })

            })
        });
    </script>

	<?php

}