<?php
$lang['active'] = 'Активно';
$lang['addlink'] = 'Добавить ссылку';
$lang['address'] = 'Адрес';
$lang['addresstext'] = 'Адрес';
$lang['addcategory'] = 'Добавить категорию';
$lang['addcompany'] = 'Добавить компанию';
$lang['addfielddef'] = 'Добавить определение поля';
$lang['admin_only'] = 'Видит только Администратор';
$lang['areyousure'] = 'Вы действительно хотите удалить это?';
$lang['ascending'] = 'По возрастанию';
$lang['cancel'] = 'Отмена';
$lang['canuseredit'] = 'Пользователи фронтенда могут редактировать это поле?';
$lang['canuserview'] = 'Пользователи фронтенда могут видеть это поле?';
$lang['category'] = 'Категория';
$lang['categories'] = 'Категории';
$lang['categorytext'] = 'Категория';
$lang['categoryadded'] = 'Категория добавлена';
$lang['categoryupdated'] = 'Категория обновлена';
$lang['categorylisttemplate_addedit'] = 'Добавить/Редактировать список шаблонов категории';
$lang['categorylisttemplates'] = 'Список шаблонов категории';
$lang['categorylisttemplateupdated'] = 'Список категорий обновлён';
$lang['changelog'] = '<ul>
  <li>1.1.3 - January, 2008 <em>(rcampbell@skinnyfishmedia.com)</em>
    <ul>
      <li>Adds pagination to summary view</li>
      <li>Fixes a problem with pretty urls in summary view</li>
    </ul>
  </li>
  <li>1.1.2 - November, 2007 <em>(rcampbell@skinnyfishmedia.com)</em>
    <ul>
      <li>Now use cms_move_uploaded_file instead of move_uploaded_file</li>
      <li>Require CMS 1.2.1 or later</li>
    </ul>
  </li>
  <li>1.1.1 - November, 2007 <em>(rcampbell@skinnyfishmedia.com)</em>
    <ul>
      <li>Fixed a problem with the detail links in summary mode when pretty urls were disabled.</li>
    </ul>
  </li>
  <li>1.1 - September, 2007 <em>(rcampbell@skinnyfishmedia.com)</em>
    <ul>
      <li>Added support for pretty urls</li>
      <li>Filled out the help</li>
      <li>Added a category list mode</li>
      <li>Added support for frontend editing of companies</li>
      <li>Added support for public and admin only fields in companies</li>
      <li>Added different sorting capabilities in summary view</li>
      <li>Changed Minimum CMS Version and added support for the 1.1 series</li>
    </ul>
  </li>
</ul>
';
$lang['company'] = 'Компания';
$lang['companyadded'] = 'Компания добавлена';
$lang['companyname'] = 'Название компании';
$lang['companyupdated'] = 'Компания обновлена';
$lang['companies'] = 'Компании';
$lang['companytext'] = 'Компания';
$lang['companydirectory'] = 'Каталог компаний';
$lang['contactemail'] = 'Контактный Email';
$lang['createddate'] = 'Дата записи';
$lang['defaulttemplates'] = 'Шаблон по умолчанию';
$lang['default_template_notice'] = '<strong>Примечание:</strong> Содержание этих текстовых областей используется для определения содержания шаблона по умолчанию, нажмите кнопку  &quot;Add Template&quot; в соответствующем шаблон на вкладке. Изменение текста одной из этих областей текст не будет иметь непосредственное влияние на Ваш сайт.';
$lang['delete'] = 'Удалить';
$lang['deletecategory'] = 'Удалить категорию';
$lang['deletecompany'] = 'Удалить компанию';
$lang['deletefielddef'] = 'Удалить определение поля';
$lang['descending'] = 'По убыванию';
$lang['description'] = 'Описание';
$lang['details'] = 'Подробности';
$lang['detailstext'] = 'Подробности';
$lang['detailtemplate_addedit'] = 'Добавить/Редактировать шаблон Detail';
$lang['detailtemplates'] = 'Шаблон Detail';
$lang['detailtemplateupdated'] = 'Шаблон Detail обновлён';
$lang['disabled'] = 'Отключено';
$lang['down'] = 'Вниз';
$lang['draft'] = 'Черновик';
$lang['edit'] = 'Редактирование';
$lang['editcategory'] = 'Редактировать категорию';
$lang['editcompany'] = 'Редактировать компанию';
$lang['editfielddef'] = 'Edit Field Definition';
$lang['emailtext'] = 'Email';
$lang['error_companyname'] = 'Название компании не верно';
$lang['error_companyname_inuse'] = 'Компания с таким названием уже находится в базе данных';
$lang['error_nofeu'] = 'Не удалось найти модуль FrontEndUsers';
$lang['exportcsv'] = 'Экспорт в CSV';
$lang['fax'] = 'Факс';
$lang['faxtext'] = 'Факс';
$lang['fielddef'] = 'Field Definition';
$lang['fielddefs'] = 'Field Definitions';
$lang['fielddeftext'] = 'Field Definition';
$lang['fielddefadded'] = 'Field Definition Added';
$lang['fielddefupdated'] = 'Field Definition Updated';
$lang['fielddefdeleted'] = 'Field Definition Deleted';
$lang['firstpage'] = '<<';
$lang['frontendformtemplate_addedit'] = 'Add/Edit Frontend Form Template';
$lang['frontendformtemplates'] = 'Edit Company Templates';
$lang['frontendformtemplateupdated'] = 'Edit Company Template Updated';
$lang['help'] = '<h3>What does this do?</h3>
<p>This module provides a way to collect, organize, and display information about companies.  Usually this is the contact information and a logo, but it is flexibile enough to allow for extendable fields, and disceminating public from private data.</p>
<p>This module could be used for a variety of purposes. From a suppliers list to a contact list.  It is flexible enough that it could be re-used for many different purposes.</p>
<h3>How Do I Use It</h3>
<p>The easiest way to use this module is by placing the <code>{CompanyDirectory}</code> tag into either your page template or page content.  You would then start editing records in the "Company Directory" admin interface.  Explore the various parameters (described below) for ways to customize the behaviour of the module.</p>
<h3>Security</h3>
<p>In order to manage the companies inside this module, the administrator must have the \'</em>Modify Company Directory</em>\' permission.</p>
<p>In order to edit the built in templates that control the layout of the companydirectory information, the administrator needs the \'<em>Modify Templates</em>\' permission.</p>
<p>To adjust the various settings, the \'<em>Modify Site Preferences</em>\' permission is required.</p>
<h3>Pretty URLS</h3>
<p>Functionality and flexibility is reduced when using pretty urls.  For example, if using pretty URLS with this module, you should post the tag for this module in the default content block, and when clicking on a link or submitting a button from this module, it\'s results will always replace the default content block.</p>';
$lang['id'] = 'Id';
$lang['imagecurrenthidden'] = '';
$lang['imagetext'] = 'Изображение';
$lang['lastpage'] = '>>';
$lang['logocurrenthidden'] = '';
$lang['logotext'] = 'Лого';
$lang['maxlength'] = 'Макс. длина';
$lang['max_length'] = 'Макс. длина';
$lang['maxlengthtext'] = 'Макс. длина';
$lang['modifieddate'] = 'Дата последнего изменения';
$lang['name'] = 'Название';
$lang['nametext'] = 'Название';
$lang['needpermission'] = 'Вам нужно иметь права \'%s\' для этого действия.';
$lang['nocompanynamegiven'] = 'Не задано название компании';
$lang['nonamegiven'] = 'Не задано название';
$lang['notanumber'] = 'Не число';
$lang['nextpage'] = '>';
$lang['of'] = 'Из';
$lang['page'] = 'Страница';
$lang['param_action'] = 'Determine the primary behaviour of the module.  Possible values for this parameter are:
<ul>
  <li>categorylist -- Display a list of categories.  Users can drill down to summary mode, andd then to detail mode.</li>
  <li><strong>default</strong> -- Display companies in a summary mode.</li>
  <li>details -- Display detailed information about a specific company.</li>
  <li>fe_edit -- Display a form to allow editing information about a specific company.</li>
   
</ul>
';
$lang['param_category'] = 'When used in the <em>default</em> summary mode, this parameter, which should match the name of an existing category will be used to display only those companies that are in that categoory. (a comma seperated list can be supplied)';
$lang['param_categorylisttemplate'] = 'Specify a template (by name) to use when displaying the category list view.';
$lang['param_companyid'] = 'Required for the frontend editing and detail modes, this parameter determines which company record to edit or view.';
$lang['param_detailpage'] = 'Specify a page alias (by name) to use for displaying a detail record. <strong>Note:</strong> This tag parameter is not compatible with pretty urls.';
$lang['param_detailtemplate'] = 'Specify a template (by name) to use when displaying the detail view.  <strong>Note:</strong> This tag parameter is not compatible with pretty urls.';
$lang['param_frontendformtemplate'] = 'Specify a template (by name) to use when displaying the front end company edit form.';
$lang['param_selectcategory'] = 'If this parameter is set, then a form will be generated allowing users to interactively filter company records on a single category.  This flag should not be used in conjunction with the \'category\' parameter.';
$lang['param_sortorder'] = 'Specify the order of sorted fields in summary view.  Possible values are:
<ul>
  <li><strong>asc</strong> -- Ascending order</li>
  <li>desc -- Descending order</li>
</ul>';
$lang['param_sortby'] = 'Applicable only in summary mode, this parameter determines the sorting of the output companies.  Possible values are:
<ul>
  <li><strong>company_name</strong></li>
  <li>phone</li>
  <li>fax</li>
  <li>email</li>
  <li>website -- The website url</li>
  <li>created -- The creation date for this company record</li>
  <li>modified -- The modified date for this company record</li>
</ul>';
$lang['param_summarytemplate'] = 'Укажите шаблон (по названию), чтобы использовать при отображении резюме. <strong>Примечание:</strong> Этот параметр тега не совместим с красивыми URL.';
$lang['postinstall'] = 'Модуль Company Directory успешно установлен';
$lang['postuninstall'] = 'Модуль Company Directory успешно удалён. Все связанные данные компаний были стёрты';
$lang['preuninstall'] = 'Вы уверены, что хотите удалить этот модуль? Удаление этого модуля навсегда сотрёт все связанные с ним данные компаний.';
$lang['prevpage'] = '<';
$lang['prompt_detailpage'] = 'Страница по умолчанию для перенаправления в режим подробно';
$lang['prompt_pagelimit'] = 'Число записей на странице для просмотра в режиме резюме';
$lang['prompt_summarysorting'] = 'Сортировка по умолчанию в режиме резюме';
$lang['prompt_summarysortorder'] = 'The default sort order in summary mode <em>(does not apply when sorting is \'random\'</em>';
$lang['prompt_template'] = 'Шаблон';
$lang['public'] = 'Общий';
$lang['published'] = 'Опубликовано';
$lang['preferences'] = 'Параметры';
$lang['random'] = 'Случайно';
$lang['resettofactory'] = 'Сбросить значения по умолчанию';
$lang['restoretodefaultsmsg'] = 'Эта операция восстановит содержание шаблона по умолчанию из системы. Вы уверены, что хотите продолжить?';
$lang['search'] = 'Поиск';
$lang['status'] = 'Статус';
$lang['submit'] = 'Отправить';
$lang['summarytemplate_addedit'] = 'Добавить/Редактировать шаблон резюме';
$lang['summarytemplates'] = 'Шаблоны резюме';
$lang['summarytemplateupdated'] = 'Шаблон резюме обновлён';
$lang['sysdefaults'] = 'Восстановить значения по умолчанию';
$lang['telephone'] = 'Телефон';
$lang['telephonetext'] = 'Телефон';
$lang['title_categorylist_dflttemplate'] = 'Категория по умолчанию списка шаблонов';
$lang['title_detail_dflttemplate'] = 'Шаблон по умолчанию для подробно';
$lang['title_frontendform_dflttemplate'] = 'Форма шаблона по умолчанию для фронтенда';
$lang['title_summary_dflttemplate'] = 'Шаблон по умолчанию для резюме';
$lang['type'] = 'Тип';
$lang['typetext'] = 'Тип';
$lang['up'] = 'Вверх';
$lang['website'] = 'Веб-сайт';
$lang['websitetext'] = 'Веб-сайт';
$lang['utmz'] = '156861353.1199273691.20.7.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/forum/forum.php|utmcmd=referral';
$lang['utma'] = '156861353.1045566600.1193164440.1199677059.1199685543.38';
$lang['utmc'] = '156861353';
?>