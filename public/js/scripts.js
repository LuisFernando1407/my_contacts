$(document).ready(function() {

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('.carousel').carousel();
        $('[data-mask]').inputmask();
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        );
        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    });

    $('[name=phone]').mask('(99) 99999-9999');

    $(function () {
        $('#contacts').DataTable();
        $('#messages').DataTable();
    });

});

function ajaxGetInfoUser(object){
    const id = object.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'GET',
        url:'../ajax/contact/' + id,
        success:function(data){

            $('#info').show();
            $('#contact_name_info').text(data.contact.name + ' ' + data.contact.last_name);
            $('#contact_email_info').text(data.contact.email + ' | ' + data.contact.phone);
        }
    });
}

function setPageEditProduct(id) {
    window.location.href = window.location.pathname +'/' +  id + '/edit';
}

function setPageEditContact(id) {
    window.location.href = window.location.pathname +'/' +  id + '/edit';
}