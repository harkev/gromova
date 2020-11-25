define(['jquery','lib/components/base/modal'], function($, Modal){

	var CustomWidget = function () {
		var self = this,
			system = self.system,
			HOST = 'http://evrywidget.ru/evrysoft_genetek/genetek.php',
			w_code,
			lead_id,
			AMO_HOST = window.location.host,
			AMO_PROXY = 'https://' + AMO_HOST + '/private/widget/proxy.php',
			customFields,
			pipelines,
			API_KEY;

		this.callbacks = {
			settings: function (){
			},

			init: function() {
				return true;
			},
			bind_actions: function(){
				user = AMOCRM.constant('user');
					$('.card-widgets__widget__caption__logo, .card-widgets__widget__caption__logo_min').on('click', function(){
						modal = new Modal({
							class_name: 'modal-window',
							init: function ($modal_body) {
								var $this = $(this);
								$modal_body
									.trigger('modal:loaded') //запускает отображение модального окна
									.html('<iframe id="iframemod" src="https://www.evrywidget.ru/harkev/gromova/index.php?user='+user['id']+'&url='+window.location.pathname +'" style="height:100%;width:100%"> Ваш браузер не поддерживает плавающие фреймы!</iframe>')
									.append('<span class="modal-body__close"><span class="icon icon-modal-close"></span></span>') //Кнопка закрытия
                                    .addClass('modalSite')
									.trigger('modal:centrify');  // настраивает модальное окно
							},		 	
							destroy: function () {
							}
						});
					});				
				return true;
			},
			render: function(){
				//alert(AMOCRM.data.current_card.id);
				//user = AMOCRM.constant('user');
				//alert(user['id']);
				w_code = self.get_settings().widget_code;
				self.render_template({
					caption:{
						class_name:'js-ac-caption',
						html:''
					},
					body:'',
					render : '<link type="text/css" rel="stylesheet" href="/upl/'+w_code+'/widget/style.css" >'
				});
				return true;
			},
			destroy: function(){
			},
			onSave: function(){
				return true;
			}
		};
		return this;
	};
	return CustomWidget;
});