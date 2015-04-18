<div class="comments-header">
    <h3>Комментарии и обсуждение (12 сообщений)</h3>
    @if(\Auth::guest())
        <p>Вы должны <a href="#">авторизоваться</a>, что бы оставить сообщение</p>
    @elseif(\Auth::user()->can('product-comments-add'))
        <p>
            <textarea name="description" class="form-control" rows="3" placeholder="введите текст комментария..." style="margin-bottom: 5px"></textarea>
            <button class="btn btn-default btn-sm">Отправить</button>
        </p>
    @else
        <p style="color: red">У вас нет прав для добавления комментариев, обратитесь к администратору</p>
    @endif
</div>