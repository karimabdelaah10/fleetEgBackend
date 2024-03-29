@include('BaseApp::form.input',[
    'name'=>'title',
     'value'=> $row->title ?? null,
     'type'=>'text',
     'attributes'=>[
         'id'=>'title',
         'class'=>'form-control',
     'label'=>trans('specs.title'),
     'placeholder'=>trans('specs.title'),
     'required'=>1]
     ])
@include('BaseApp::form.switch',[
    'name'=>'is_active',
    'value'=> $row->is_active ?? null,
     'attributes'=>[
         'id'=>'is_active',
         'class'=>'form-control',
     'label'=>trans('app.status')]
     ])
