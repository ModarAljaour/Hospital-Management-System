<div>

    @if($message === true )
        <script src="">
            alert("تم ارسال الحجز بنجاح")
            location.reload()
        </script>
    @endif

        @if($msg === true )
            <script src="">
                alert("عذرا الطبيب انهى مواعيده اليوم .. حاول في يوم اخر")
                location.reload()
            </script>
        @endif


    <form wire:submit.prevent="store">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="text"   name="name"  wire:model="name"  placeholder="your name" required="">
                <span class="icon fa fa-user"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="email" name="email"  wire:model="email"   placeholder="Enter your email" required="">
                <span class="icon fa fa-envelope"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">doctor</label>
                <select  class="form-select"  name="doctor"  wire:model="doctor"  id="exampleFormControlSelect1">
                    <option>-- اختار من القائمة --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id  }}">{{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">section</label>
                <select class="form-select"  name="section"  wire:model="section" id="exampleFormControlSelect1">
                    <option>-- اختار من القائمة --</option>
                    @foreach($sections as $section)
                    <option value="{{ $section->id  }}">{{$section->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                <input type="tel" placeholder=" phone"  name="phone"  wire:model="phone" required="">
                <span class="icon fas fa-phone"></span>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">Date </label>
                <input type="date" placeholder=" date"  name="date"  wire:model="date" required="" class="form-control">

            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea  placeholder="notes"  name="notes"  wire:notes="doctor" ></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">submit</span></button>
            </div>
        </div>
    </form>
</div>
