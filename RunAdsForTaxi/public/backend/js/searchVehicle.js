window.addEventListener('load',(event)=>{
    var iptSearchVehicle = document.querySelector('.ipt-search-vehicle');
    iptSearchVehicle.addEventListener('focus',(event)=>{
        setIsShowResultVehicle(true)
    })
    iptSearchVehicle.addEventListener('keyup',(event)=>{
        const textVehicleNumber = event.currentTarget.value.trim();
        if(textVehicleNumber.length>0)
        {
            requestSearchVehicleByVehicleNumber(textVehicleNumber)

        }

    })
    document.addEventListener('click',(event)=>{
        const viewResultVehicle = document.querySelector('.section-search-search-vehicle');
        setIsShowResultVehicle(viewResultVehicle.contains(event.target))
    })
})
function setIsShowResultVehicle(isShow)
{
    if(isShow)
    {
        document.querySelector('.dropdown-result-vehicle').style.display = 'block'
    }
    else
    {
        document.querySelector('.dropdown-result-vehicle').style.display = 'none'
    }
}
function loadResultVehicle(result)
{
    const viewListResultVehicle = document.querySelector('.list-result-vehicle');

    const dataListVehicle = result.data;
    viewListResultVehicle.innerHTML=`
    ${
        dataListVehicle.map(itemVehicle=>{
            return `
                <a href="/vehicle/update-vehicle/${itemVehicle.id}" class="item-result-vehicle">
                    <i class="fa-solid fa-vehicle"></i>
                    ${itemVehicle.vehicle_num}
                </a>
            `
        }).join('')
    }`

}
function requestSearchVehicleByVehicleNumber(textVehicleNumber)
{
    var form = new FormData()
    form.append('textVehicleNumber',textVehicleNumber)
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/vehicle/search-vehicle-number',
            type:'POST',
            data:form,
            processData: false,
            contentType: false,
            success:function(result)
            {
                loadResultVehicle(result)
            }
        }
    )
}
