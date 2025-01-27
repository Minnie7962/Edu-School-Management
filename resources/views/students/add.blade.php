@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> បន្ថែមសិស្ស
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">ទំព័រដើម</a></li>
                            <li class="breadcrumb-item active" aria-current="page">បន្ថែមសិស្ស</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <p class="text-primary">
                        <small><i class="bi bi-exclamation-diamond-fill me-2"></i> សូមចងចាំបង្កើត "ថ្នាក់" និង "ផ្នែក" មុនពេលបន្ថែមសិស្ស។</small>
                    </p>
                    <div class="mb-4">
                        <form class="row g-3" action="{{route('school.student.create')}}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="inputFirstName" class="form-label">នាម<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="នាម" required value="{{old('first_name')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputLastName" class="form-label">នាមត្រកូល<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="នាមត្រកូល" required value="{{old('last_name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">អ៊ីមែល<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" required value="{{old('email')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">ពាក្យសម្ងាត់<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="password" class="form-control" id="inputPassword4" name="password" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="formFile" class="form-label">រូបថត</label>
                                    <input class="form-control" type="file" id="formFile" onchange="previewFile()">
                                    <div id="previewPhoto"></div>
                                    <input type="hidden" id="photoHiddenInput" name="photo" value="">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputBirthday" class="form-label">ថ្ងៃខែឆ្នាំកំណើត<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="date" class="form-control" id="inputBirthday" name="birthday" placeholder="ថ្ងៃខែឆ្នាំកំណើត" required value="{{old('birthday')}}">
                                </div>
                                <div class="col-3-md">
                                    <label for="inputAddress" class="form-label">អាសយដ្ឋាន<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="ផ្លូវលេខ ..." required value="{{old('address')}}">
                                </div>
                                <div class="col-3-md">
                                    <label for="inputAddress2" class="form-label">អាសយដ្ឋាន ២</label>
                                    <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="ផ្ទះលេខ ..." value="{{old('address2')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputCity" class="form-label">ទីក្រុង<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputCity" class="form-select" name="city" required>
                                        <option value="បន្ទាយមានជ័យ">បន្ទាយមានជ័យ</option>
                                        <option value="បាត់ដំបង">បាត់ដំបង</option>
                                        <option value="កំពង់ចាម">កំពង់ចាម</option>
                                        <option value="កំពង់ឆ្នាំង">កំពង់ឆ្នាំង</option>
                                        <option value="កំពង់ស្ពឺ">កំពង់ស្ពឺ</option>
                                        <option value="កំពង់ធំ">កំពង់ធំ</option>
                                        <option value="កំពត">កំពត</option>
                                        <option value="កណ្ដាល">កណ្ដាល</option>
                                        <option value="កែប">កែប</option>
                                        <option value="កោះកុង">កោះកុង</option>
                                        <option value="ក្រចេះ">ក្រចេះ</option>
                                        <option value="មណ្ឌលគីរី">មណ្ឌលគីរី</option>
                                        <option value="ឧត្តរមានជ័យ">ឧត្តរមានជ័យ</option>
                                        <option value="ប៉ៃលិន">ប៉ៃលិន</option>
                                        <option value="ភ្នំពេញ">ភ្នំពេញ</option>
                                        <option value="ព្រះសីហនុ">ព្រះសីហនុ</option>
                                        <option value="ព្រះវិហារ">ព្រះវិហារ</option>
                                        <option value="ព្រៃវែង">ព្រៃវែង</option>
                                        <option value="ពោធិ៍សាត់">ពោធិ៍សាត់</option>
                                        <option value="រតនគីរី">រតនគីរី</option>
                                        <option value="សៀមរាប">សៀមរាប</option>
                                        <option value="ស្ទឹងត្រែង">ស្ទឹងត្រែង</option>
                                        <option value="ស្វាយរៀង">ស្វាយរៀង</option>
                                        <option value="តាកែវ">តាកែវ</option>
                                        <option value="ត្បូងឃ្មុំ">ត្បូងឃ្មុំ</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputZip" class="form-label">លេខកូដ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputZip" name="zip" required value="{{old('zip')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputState" class="form-label">ភេទ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputState" class="form-select" name="gender" required>
                                        <option value="ប្រុស">ប្រុស</option>
                                        <option value="ស្រី">ស្រី</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputNationality" class="form-label">សញ្ជាតិ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputNationality" name="nationality" placeholder="ខ្មែរ" required value="{{old('nationality')}}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="inputPhone" class="form-label">លេខទូរស័ព្ទ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="+855 ..." required value="{{old('phone')}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputIdCardNumber" class="form-label">លេខអត្តសញ្ញាណប័ណ្ណ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputIdCardNumber" name="id_card_number" placeholder="ឆ្នាំ-ផ្នែក-ថ្នាក់-ផ្នែក-លេខ" required value="{{old('id_card_number')}}">
                                </div>
                            </div>
                            <div class="row mt-4 g-3">
                                <h6>ព័ត៌មានឪពុកម្តាយ</h6>
                                <div class="col-md-3">
                                    <label for="inputFatherName" class="form-label">ឈ្មោះឪពុក<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFatherName" name="father_name" placeholder="ឈ្មោះឪពុក" required value="{{old('father_name')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputFatherPhone" class="form-label">លេខទូរស័ព្ទឪពុក<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFatherPhone" name="father_phone" placeholder="+855 ..." required value="{{old('father_phone')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMotherName" class="form-label">ឈ្មោះម្តាយ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputMotherName" name="mother_name" placeholder="ឈ្មោះម្តាយ" required value="{{old('mother_name')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMotherPhone" class="form-label">លេខទូរស័ព្ទម្តាយ<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputMotherPhone" name="mother_phone" placeholder="+855 ..." required value="{{old('mother_name')}}">
                                </div>
                                <div class="col-4-md">
                                    <label for="inputParentAddress" class="form-label">អាសយដ្ឋាន<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputParentAddress" name="parent_address" placeholder="ផ្លូវជាតិលេខ 5" required value="{{old('parent_address')}}">
                                </div>
                            </div>
                            <div class="row mt-4 g-3">
                                <h6>ព័ត៌មានសិក្សា</h6>
                                <div class="col-md-6">
                                    <label for="inputAssignToClass" class="form-label">ថ្នាក់<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select onchange="getSections(this);" class="form-select" id="inputAssignToClass" name="class_id" required>
                                        @isset($school_classes)
                                            <option selected disabled>សូមជ្រើសរើសថ្នាក់</option>
                                            @foreach ($school_classes as $school_class)
                                                <option value="{{$school_class->id}}" >{{$school_class->class_name}}</option>
                                            @endforeach
                                            <option value="1">ថ្នាក់ទី១</option>
                                            <option value="2">ថ្នាក់ទី២</option>
                                            <option value="3">ថ្នាក់ទី៣</option>
                                            <option value="4">ថ្នាក់ទី៤</option>
                                            <option value="5">ថ្នាក់ទី៥</option>
                                            <option value="6">ថ្នាក់ទី៦</option>
                                        @endisset
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="inputBoardRegistrationNumber" class="form-label">លេខចុះឈ្មោះ</label>
                                    <input type="text" class="form-control" id="inputBoardRegistrationNumber" name="board_reg_no" placeholder="លេខចុះឈ្មោះ" value="{{old('board_reg_no')}}">
                                </div>
                                <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            </div>
                            <div class="row mt-4">
                                <div class="col-12-md">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-plus"></i> បន្ថែម</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getSections(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('inputAssignToSection');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'សូមជ្រើសរើសផ្នែក'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
@include('components.photos.photo-input')
@endsection