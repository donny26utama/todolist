jQuery(document).ready(function() {
	taskApp.init();
});

var formTask = $("#form-task");
var token = $("input[name=_token]");
var inputTask = $("#input-task");
var buttonAdd = $("#button-add");
var buttonDelete = $(".btn-delete");
var buttonSelected = $("#button-selected");
var checkTask = $(".check-task");
var ulTask = $("#ul-task");
var btnDefault = 'btn-default';
var btnSuccess = 'btn-success';
var btnDanger = 'btn-danger';
var attrDisabled = 'disabled';
var taskApp = {
	getSelected: function(){
		var data = [];
		$("input:checkbox:checked").each(function(){
			data.push($(this).val());
		});
		return data;
	},
	init: function(){
		$('[data-toggle="tooltip"]').tooltip();
		buttonAdd.attr('disabled', true);
		buttonSelected.attr('disabled', true);
		inputTask.on('change keyup', function() {
			if ($(this).val().length == 0) {
				buttonAdd.attr(attrDisabled, true);
				buttonAdd.removeClass(btnSuccess);
				buttonAdd.addClass(btnDefault);
			} else {
				buttonAdd.removeAttr(attrDisabled);
				buttonAdd.removeClass(btnDefault);
				buttonAdd.addClass(btnSuccess);
			}
		});
		formTask.submit(function(e) {
			var url = '/addTask';
			var data = {
				_token: token.val(),
				task: inputTask.val()
			}
			$.ajax({
				url: url,
				type: 'POST',
				data: data,
				success: function(data){
					if(data.status){
						ulTask.append(data.content);
					}
				}
			});
			inputTask.val('');
			
			e.preventDefault();
		});
		$(document).on('click', '.btn-delete', function() {
			var url = '/removeTask';
			var data = {
				_token: token.val(),
				task_id: $(this).attr('id')
			};
			var el = $(this);
			$.ajax({
				url: url,
				type: 'POST',
				data: data,
				success: function(data){
					if(data.status){
						el.parent().fadeOut("fast", function() { $(this).remove(); });
					}
				}
			});
		});
		$(document).on('change', '.check-task', function() {
			console.log( $(this).is(':checked'), $("input:checkbox:checked").length);
			if($("input:checkbox:checked").length > 0){
				buttonSelected.removeAttr(attrDisabled);
				buttonSelected.removeClass(btnDefault);
				buttonSelected.addClass(btnDanger);
			} else {
				buttonSelected.attr(attrDisabled, true);
				buttonSelected.removeClass(btnDanger);
				buttonSelected.addClass(btnDefault);
			}
		});
		buttonSelected.click(function(e) {
			var list = taskApp.getSelected();
			var url = '/removeSelected';
			var data = {
				_token: token.val(),
				task_id: list
			};
			console.log(data);
			$.ajax({
				url: url,
				type: 'POST',
				data: data,
				success: function(data){
					if(data.status){
						jQuery.each(list, function(index, val) {
							var el = $("#task-"+val);
							el.parent().parent().fadeOut("fast", function() { $(this).remove(); });
						});
					}
				}
			});
			
			e.preventDefault();
		});
	}
}