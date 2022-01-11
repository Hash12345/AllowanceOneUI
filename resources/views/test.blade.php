@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div id="my-toggle" class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Test Block</h3>
                    </div>
                    <div class="block-content">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat sapiente atque in velit corporis iure dolore pariatur soluta deleniti? Beatae ut iure sapiente hic aperiam non reprehenderit architecto cumque optio!
                        Amet praesentium, modi minus eius, libero perspiciatis asperiores officia soluta aperiam, esse temporibus veniam. Reiciendis quae error vel labore dolore aperiam voluptatem, minima libero ducimus magnam, ad dignissimos exercitationem aliquam!
                        Id, nesciunt eligendi. Debitis animi quisquam esse officia dolorem. Recusandae, quae est? Nemo consectetur pariatur minus, asperiores, magnam distinctio tempora, consequatur autem ipsa delectus minima qui veniam. Perferendis, inventore porro?</p>
                    </div>
                </div>
                <div class="block-content">
                    <button class="btn btn-primary" onclick="One.block('state_toggle', '#my-toggle')">Button 1</button>
                </div> 
            </div>
        </div>

    </div>
@endsection