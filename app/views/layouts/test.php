<script>
    function sendForm()
    {
        var id = $('input[name=id]').val();
        var data = {
            name: $('input[name=name]').val(),
            vendor: $('input[name=vendor]').val(),
            model: $('input[name=model]').val(),
            description: $('input[name=description]').val()
        };
        $.ajax({
            url: '/?controller=rest' + (id == '' ? '' : ('&id=' + id)),
            data: data,
            dataType: 'JSON',
            method: 'DELETE',
            success: function (r) {
                console.log(r);
            }
        });
    }
</script>
<form >
    <input type="text" name="id" value="<?php echo ''; ?>"><br />
    <input type="text" name="name" value="<?php echo ''; ?>"><br />
    <input type="text" name="vendor" value="<?php echo ''; ?>"><br />
    <input type="text" name="model" value=""><br />
    <input type="text" name="description" value=""><br />
    <input type="button" onclick="sendForm();return false;">
</form>