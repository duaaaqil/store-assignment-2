//LOGIN AJAX
$('#login_form').on('submit', function(e){
    e.preventDefault();
    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
        url: "ajax-files/login-user.php",
        method:"POST",
        data: {
            email: email,
            password: password,
        },
        success: function(data) {
            location.href = 'index.php';   
        }
    });
});

//REGISTRATION AJAX
$('#registration_form').on('submit', function(e){
    e.preventDefault();
    var name = $('#name').val();
    var userName = $('#user_name').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();
    var email = $('#email').val();
    $.ajax({
        url: "ajax-files/add-user.php",
        method:"POST",
        data: {
            name: name,
            userName: userName,
            password: password,
            email: email,
            confirm_password: confirm_password,
        },
        success: function(data) {
            alert(data);
        }
    });
});

// DELETE AJAX
$('.delete-button').click(function(e) {
    var uniqueId = e.delegateTarget.attributes.getNamedItem('data-uniqueid').value;
    var tablename = e.delegateTarget.attributes.getNamedItem('data-tablename').value;
    e.preventDefault();
    $.ajax({
        url: "ajax-files/delete-ajax.php",
        method:"POST",
        data : {
          tName : tablename,
          id : uniqueId
        },
        success: function(data) {
            location.reload(true);
        }
    });
});

// EDIT AJAX
$('.edit-button').click(function(e) {
    var uniqueId = e.delegateTarget.attributes.getNamedItem('data-uniqueid').value;
    var tablename = e.delegateTarget.attributes.getNamedItem('data-tablename').value;
    e.preventDefault();
    $('#edit_form').show();
    $('#editForm').on('submit', function(e){
        e.preventDefault();
        var category_name_To_edit = $('#edit_category_name').val();
        var brand_name_To_edit = $('#edit_brand_name').val();
        var product_name_To_edit = $('#edit_product_name').val();
        var product_price_To_edit = $('#edit_product_price').val();
        var product_brand_To_edit = $('#edit_select_brand').val();
        var product_category_To_edit = $('#edit_select_category').val();
        $.ajax({
            url: "ajax-files/edit-ajax.php",
            method:"POST",
            data : {
              tName : tablename,
              id : uniqueId,
              category_name_To_edit : category_name_To_edit,
              brand_name_To_edit : brand_name_To_edit,
              product_name_To_edit : product_name_To_edit,
              product_price_To_edit :  product_price_To_edit,
              product_brand_To_edit :  product_brand_To_edit,
              product_category_To_edit : product_category_To_edit,
            },
            success: function(data) {
                alert(' UPDATED SUCCESSFULLY');
                location.reload(true);
            }
        });
     });
});


// ADD FIELD AJAX
$('#addForm').on('submit', function(e){
    e.preventDefault();
    var add_form_value = $('#add_form').val();
    var tablename = $('#tableName').val();
    var selectBrand = $('#select_brand').val();
    var selectCategory = $('#select_category').val();
    var price = $('#price').val();
    var fileName = $('#file_name').val();
    $.ajax({
        url: "ajax-files/add-ajax.php",
        method:"POST",
        data : {
          tName : tablename,
          addValue : add_form_value, 
          selectCategory : selectCategory,
          selectBrand : selectBrand,
          price : price,
          fileName : fileName,
        },
        success: function(data) {
            location.reload(true);
        }
    });

});