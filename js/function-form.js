var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
    var label	 = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
        var fileName = '';
        if( this.files && this.files.length > 1 )
            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
        else
            fileName = e.target.value.split( '\\' ).pop();

        if( fileName )
            label.querySelector( 'span' ).innerHTML = fileName;
        else
            label.innerHTML = labelVal;
    });
});

/*
$( document ).ready(function() {
    $('#s-h-pass').click(function(){
        var type = $('#passwordR').attr('type') == "text" ? "password" : 'text',
            c = $(this).html() == "<span class=\"fa-eye-slash\" title=\"Скрыть пароль\"></span>" ? "<span class=\"fa fa-eye\" title=\"Показать пароль\"></span>" : "<span class=\"fa fa-eye-slash\" title=\"Скрыть пароль\"></span>";
        $(this).html(c);
        $('#passwordR').prop('type', type);
    });
});*/