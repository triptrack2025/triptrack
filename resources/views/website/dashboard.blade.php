@include('website.header')

<style>
   .card-u{
    background:white;
   }
   .bagIcon{
    padding-bottom:10px;
   }
   b{
    color:black;
   }
   hr {
    margin-top: 1rem;
    border-top: 5px solid #212529;
    }
    .info{
        padding-top:10px;
    }
    
</style>

<section id="download-app" class="leaf-pattern-overlay">    
    <div class="container">

        <div class="row">
            <div class="col-md-12 card-u p-3">
                <!-- Modal for Deactivating Tag -->
                <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id="modalMessage"></p> <!-- Dynamic Message -->
                            </div>
                            <div class="modal-footer">
                                <a id="confirmDeactivate" href="#" class="btn btn-danger">Deactivate</a> <!-- Button Text will Change -->
                                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($userTags as $key => $userTagValue)
                    <div class="row">
                        <div class="col-md-1 mt-3">
                            <div class="d-flex bagIcon">
                                <img src="{{ url('/assets/images/'.$userTagValue->tag_image) }}" 
                                    alt="{{ config('constant.valuable_type.' . $userTagValue->valuable_type) }}" 
                                    class="me-3" style="width: 100px;">
                            </div>
                            <div class="d-flex">
                                <img alt="qr" src="https://storage.googleapis.com/pettag/qr/assets/qrcode.png" 
                                    style="width: 20px; height: 20px;">
                                <p style="font-size: 0.75rem;padding-left:4px; color:black;"> 
                                    <b>{{ $userTagValue->tag_id }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <b>Valuable Type: {{ config('constant.valuable_type.' . $userTagValue->valuable_type) }}</b><br>
                            <b>Bag Brand: {{ $userTagValue->bag_brand }}</b><br>
                            <!-- <b>Purchase Date: 24 Feb, 2025</b> -->
                        </div>
                        <div class="col-md-5 mt-3 text-end">
                            <div class="status">
                                @if($userTagValue->tag_status == 'active')
                                    <span class="text-success">● Active</span>
                                @elseif($userTagValue->tag_status == 'deactive')
                                    <span class="text-danger">● Inactive</span>
                                @elseif($userTagValue->tag_status == 'Report Lost')
                                    <span class="text-danger">● Report Lost</span>
                                @endif
                                <p>Active Since: {{ $userTagValue->formatted_tag_active_date }}</p>
                            </div>
                            <div class="info">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{url('bag-details/'.$userTagValue->tag_id)}}">
                                            <i class="fa fa-pencil menu-drop" style="color: rgba(255, 194, 0, 0.97); font-size: 20px;"></i>
                                        </a>
                                        <i class="fa fa-ellipsis-v menu-drop" data-bs-toggle="dropdown" aria-expanded="false" 
                                        style="width: 20px; color: rgba(255, 194, 0, 0.97); font-size: 20px;"></i>
                                        <ul class="dropdown-menu">

                                        
                                            <li>
                                                <a href="#" class="dropdown-item deactivate-tag" 
                                                data-tag-id="{{ $userTagValue->tag_id }}" 
                                                data-tag-status="{{ $userTagValue->tag_status }}" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deactivateModal">
                                                {{ $userTagValue->tag_status == 'active' ? 'Deactivate Tag' : 'Activate Tag' }}
                                                </a>
                                            </li>
                                            @if($userTagValue->tag_status == 'active' || $userTagValue->tag_status == 'deactive')
                                             <li><a class="dropdown-item" href="{{ url('tag/status/'.$userTagValue->tag_id.'/report_lost') }}">Report Lost</a></li>
                                            @elseif($userTagValue->tag_status == 'Report Lost')
                                             <li><a class="dropdown-item" href="{{ url('tag/status/'.$userTagValue->tag_id.'/report_found') }}">Report Found</a></li>
                                            @endif
                                            <li><a class="dropdown-item" href="{{url('bag-details/'.$userTagValue->tag_id)}}">Bag Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach

                <!-- Pagination Links -->
                <div class="mt-2">
                    {{ $userTags->links() }}
                </div>
            </div>
        </div>
    </div>
    
</section>

@include('website.footer')

<script>
    document.querySelectorAll('.relative.z-0.inline-flex.rtl\\:flex-row-reverse.shadow-sm.rounded-md svg')
    .forEach(svg => svg.style.width = '30px');

    let firstDiv = document.querySelector("nav .flex.justify-between.flex-1.sm\\:hidden");
    if (firstDiv) {
        firstDiv.remove();
    }


    document.querySelectorAll('.deactivate-tag').forEach(button => {
        button.addEventListener('click', function () {
            let tagId = this.getAttribute('data-tag-id');
            let tagStatus = this.getAttribute('data-tag-status');
            let modalMessage = document.getElementById('modalMessage');
            let confirmButton = document.getElementById('confirmDeactivate');

            // Change Modal Message
            modalMessage.innerHTML = `Are you sure you want to ${tagStatus == 'active' ? 'deactivate' : 'activate'} the tag <b>${tagId}</b>?`;

            // Change Button Text
            confirmButton.innerHTML = tagStatus == 'active' ? 'Deactivate' : 'Activate';
            confirmButton.classList.toggle('btn-danger', tagStatus == 'active');
            confirmButton.classList.toggle('btn-success', tagStatus != 'active');

            // Dynamic URL
            confirmButton.href = "{{ url('tag/status') }}/" + tagId + "/" + (tagStatus == 'active' ? 'deactive' : 'active');
        });
    });


</script>




