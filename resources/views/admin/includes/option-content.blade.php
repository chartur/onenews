<div class="card tasks sameheight-item" data-exclude="xs,sm">
    <div class="card-header bordered">
        <div class="header-block">
            <h3 class="title"> Պարունակություն </h3>
        </div>
    </div>
    <div class="card-block">
        <div class="tasks-block">
            <div>
                <textarea class="form-control" rows="5" name="option-content">{{ $option->content }}</textarea>
                <button class="btn btn-primary btn-block mt-2 save-option-content">Պահպանել</button>
            <div>
        </div>
    </div>
</div>

<script>
    $(".save-option-content").click(function() {
        console.log("test");
        const content = $("textarea[name=option-content]").val().trim();

        $.ajax({
            url: '/cabinet/options/content/{{ $option->id }}',
            type: 'post',
            data: {
                content
            },
            dataType: 'json',
            complete: NProgress.done,
            success: function(res) {
                showMessage(res.status, res.message)
            },
            error: function (err) {
                showMessage(err.responseJSON.status, err.responseJSON.message);
            }
        })
    })
</script>