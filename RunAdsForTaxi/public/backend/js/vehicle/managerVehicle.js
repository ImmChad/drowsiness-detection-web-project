window.addEventListener('load',()=>{
    loadHandleBtnSubmitUpdateVehicle()
    loadHandleBtnSubmitAddVehicle()
    loadHandle_AllBtnDeleteRowVehicles()
})
function loadHandleBtnSubmitUpdateVehicle()
{
    const btnUpdate = document.querySelector('.btn-update-vehicle');
    if(btnUpdate)
    {
        btnUpdate.addEventListener('click',(event)=>{
            requestUpdateVehicle({
                value_vehicle_number:document.querySelector('#ipt_vehicle_number').value,
                value_group_id:document.querySelector('#ipt_group_id').getAttribute('data-value'),
                value_tablet_id:document.querySelector('#ipt_tablet_id').value,
                value_number_phone:document.querySelector('#ipt_number_phone').value,
                value_app_id:document.querySelector('#ipt_app_id').value,
                value_vehicle_id:document.querySelector('.btn-update-vehicle').getAttribute('data-value'),
            })
        })
    }

}
function requestUpdateVehicle({
    value_vehicle_number,
    value_group_id,
    value_tablet_id,
    value_number_phone,
    value_app_id,
    value_vehicle_id,
})
{
    var form = new FormData()
    form.append('value_vehicle_number',value_vehicle_number)
    form.append('value_group_id',value_group_id)
    form.append('value_tablet_id',value_tablet_id)
    form.append('value_number_phone',value_number_phone)
    form.append('value_app_id',value_app_id)
    form.append('value_vehicle_id',value_vehicle_id)
    if(checkValidInput(formData_to_Object(form)))
    {
        fetch('/vehicle/update-new-vehicle',{
            method:'POST',
            body:form,
            // headers,
        }).then(res=>res.json()).then(result=>{
            if(result.isSuccess)
            {

            }
            else
            {

            }
            displayToast(result.mess)
        })
    }

}
function loadHandleBtnSubmitAddVehicle()
{
    var btnAdd = document.querySelector('.btn-add-vehicle');
    if(btnAdd)
    {
        btnAdd.addEventListener('click',(event)=>{
            requestAddVehicle({
                value_vehicle_number:document.querySelector('#ipt_vehicle_number').value,
                value_group_id:document.querySelector('#ipt_group_id').getAttribute('data-value'),
                value_number_phone:document.querySelector('#ipt_number_phone').value,
            })
        })
    }

}
function requestAddVehicle({
    value_vehicle_number,
    value_group_id,
    value_number_phone,
})
{
    var form = new FormData()
    form.append('value_vehicle_number',value_vehicle_number)
    form.append('value_group_id',value_group_id)
    form.append('value_number_phone',value_number_phone)


    if(checkValidInput(formData_to_Object(form)))
    {
        fetch('/vehicle/add-new-vehicle',{
            method:'POST',
            body:form,
        }).then(res=>res.json()).then(result=>{
            if(result.isSuccess)
            {

            }
            else
            {

            }
            displayToast(result.mess);

        })
    }



}
function checkValidInput(retrievedForm)
{
    var isInValid = Object.values(retrievedForm).some((value)=>{
        return value == "" || value == null
    })
    console.log(retrievedForm,isInValid);
    if(isInValid)
    {
        displayToast('Invalid Input Data!!!');
    }
    return !isInValid
}
function formData_to_Object(formData)
{
    var retrieved = {};
    var data = formData.entries();
    var obj = data.next().value;
    while(obj) {
        var [key,value] = obj
        retrieved[key] = value;
        obj = data.next().value;
    }
    return retrieved
}
function loadHandle_AllBtnDeleteRowVehicles()
{
    let btnDeleteVehicles = document.querySelectorAll('.btn-delete-vehicle');
    btnDeleteVehicles.forEach((btnDeleteVehicle) => {
        btnDeleteVehicle.addEventListener('click',(event)=>{
            isShowPopUpDeleteRow(true,event.currentTarget.getAttribute('data-id'));
        })
})
}
function isShowPopUpDeleteRow(isShow,delete_id)
{
    if(isShow)
    {
        let popUpAds = document.querySelector('.pop-up-ads');
        popUpAds.classList.add('active');

        let newHTML = `
            <div class="col-lg-6 div-edit-layout" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                <div class="card " style="border: 4px solid #0e5904; border-radius: 25px; width: 100%;">
                    <div class="card-body">
                        <div style="display: flex;justify-content: space-between">
                            <div class="card-title col-sm-7" style="font-size: 30px; font-weight: 900;">WARNING DELETE</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="form-group row">
                                        <div class="form-group col-md-12">
                                            <h4 style="font-size: 20px; font-weight: 900;">Confirm delete: </h4>
                                            <input type="password" class="input-ads" id="password_admin" placeholder="Enter your password ..." >
                                        </div>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button type="button" class="button-ads btn_confirm_delete">Delete</button>
                                        <button type="button" class="button-ads btn_cancer_delete">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.querySelector('.pop-up-ads').insertAdjacentHTML('beforeend', newHTML);

        //  Set event click closes in pop up
        let exitPopUpAds = popUpAds.querySelector('.exit-pop-up-ads');
        exitPopUpAds.addEventListener('click', (e) => {
            popUpAds.classList.remove('active');
            let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
            divEditLayout.forEach((item) => {
                item.remove();
            });
        });



        loadFormVerifyAdmin(popUpAds,delete_id)


    }
}
function loadFormVerifyAdmin(popUpAds,delete_id)
{
    // set event click CANCEL DELETE
    let btnCancerDelete = document.querySelector('.btn_cancer_delete');
    btnCancerDelete.addEventListener('click', (e) => {
        popUpAds.classList.remove('active');
        let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
        divEditLayout.forEach((item) => {
            item.remove();
        });
    });

    // set event click CONFIRM DELETE
    let btnConfirmDelete = document.querySelector('.btn_confirm_delete');
    btnConfirmDelete.addEventListener('click', (e) => {

        let password_admin = $('#password_admin').val();
        requestDeleteVehicle(delete_id,password_admin)

    });
}
function requestDeleteVehicle(vehicleId,password_admin)
{
    const form = new FormData();
    form.append('vehicle_id', vehicleId);
    form.append('password_admin', password_admin);
    if(checkValidInput(formData_to_Object(form)))
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/vehicle/delete-vehicle',
            method: 'post',
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(result) {
                if(result.isSuccess)
                {
                    let popUpAds = document.querySelector('.pop-up-ads');
                    popUpAds.classList.remove('active');
                    let divEditLayout = popUpAds.querySelectorAll('.div-edit-layout');
                    divEditLayout.forEach((item) => {
                        item.remove();
                    });
                    document.querySelector(`#all-table span[data-id='${vehicleId}']`).closest('tr').remove();
                }
                else
                {

                }
                displayToast(result.mess);
            },
            error: function(data) {
                displayToast(data.responseText);
                console.log(data.responseText);
            }
        });
    }
}
