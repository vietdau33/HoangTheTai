<div class="container">
    <div id="form_add_user_admin">
        <div class="row set_bg_add_user mt-3 mr-0 ml-0">
            <div class="col-4" style="margin-top: 36px;">
                <div class="form-group">
                    <label for="crs_username">Username</label>
                    <input type="text" class="input-login w-100" id="crs_username" name="username" title="<?=__('username_input')?>" placeholder="<?=__('username_input')?>...">
                </div>
            </div>
            <div class="col-4" style="margin-top: 36px;">
                <div class="form-group">
                    <label for="crs_password">Password</label>
                    <input type="text" class="input-login w-100" id="crs_password" name="password" title="<?=__('password_input')?>" placeholder="<?=__('password_input')?>..." autocomplete="off">
                </div>
            </div>
            <div class="col-4" style="margin-top: 64px;position: relative;top: 2px;">
                <div class="form-group text-center">
                    <button class="btn-custom text-uppercase w-100" id="createUserButton" style="color: #fff;">Create enterprise</button>
                </div>
            </div>
        </div>
    </div>
    <div id="table_member_area" class="reset-color mt-3">
        <?=$this->render('admin.table_member')?>
    </div>
</div>

<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassworLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=__('change_password')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_change" id="id_change">
                <div class="form-group">
                    <label for="username_change" class="col-form-label"><?=__('username')?></label>
                    <input type="text" class="form-control" id="username_change" disabled>
                </div>
                <div class="form-group">
                    <label for="password_change" class="col-form-label"><?=__('new_password')?></label>
                    <input type="text" class="form-control" id="password_change" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=__('close')?></button>
                <button type="button" class="btn btn-primary saveChangePassword"><?=__('save')?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#createUserButton").on('click', createUserFunc);
        $(".editPassword").on('click', editPasswordFunc);
        $(".saveChangePassword").on('click', saveChangePasswordFunc);

    });
</script>

<script>
    function createUserFunc(){
        var username = $('input[name=username]').val().trim();
        var password = $('input[name=password]').val().trim();
        if(username == ''){
            alertify.error('<?=__('username_empty')?>');
            $('input[name=username]').css({'border-color' : 'red'}).one('focus', function(){
                $(this).css({'border-color': ''})
            })
            return false;
        }
        if(password == ''){
            alertify.error('<?=__('password_empty')?>');
            $('input[name=password]').css({'border-color' : 'red'}).one('focus', function(){
                $(this).css({'border-color': ''})
            })
            return false;
        }
        var params = {
            username : username,
            password : password
        };
        alertify.confirm('Create User "' + username + '"?', function () {
            _ajax(base_url + '/member/admin_create_user', params, function(result){
                if(result.code == 200){
                    $("#table_member").empty().append(result.html);
                    alertify.success(result.message);
                }else{
                    alertify.error(result.message);
                }
                $('input[name=password]').val('');
                $('input[name=username]').val('').focus();
                return false;
            })
        }).set({'title' : 'Confirm'})
    }
    function editPasswordFunc(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tr = $(this).closest('tr');
        var username = tr.find('.username').text();
        $("#changePassword").find("#username_change").val(username);
        $("#changePassword").find("#id_change").val(id);
        $("#changePassword").modal('show');
    }
    function saveChangePasswordFunc() {
        var $modal = $("#changePassword");
        var id = $modal.find('#id_change').val();
        var password = $modal.find('#password_change').val().trim();
        if(password == ''){
            alertify.error('<?=__('password_empty')?>');
            return false;
        }
        _ajax(base_url + '/member/change_password', {
            id : id,
            password : password
        }, function(result){
            if(result.code == 200){
                alertify.success(result.message);
                $modal.find('#password_change').val('');
                $modal.modal('hide');
            }else{
                alertify.error(result.message);
            }
        })
    }
</script>