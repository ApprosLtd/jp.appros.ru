<div class="modal" id="editCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Новая категория</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="/seller/products/save-category">
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Наименование*</label>
                        <input name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Родительская категория</label>
                        <select multiple class="form-control" style="height: 400px" name="parent_id">
                            @foreach ($categories_models as $category_model)
                                <option value="{{ $category_model->id }}">{{ $category_model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="help-block">* - Обязательно для заполнения</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#editCategory form').submit()">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>