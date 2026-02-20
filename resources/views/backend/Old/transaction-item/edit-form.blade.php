<div class="card-body" id="editForm" style="display: none">
    <h5 class="card-title text-primary mb-3">একাউন্টের তথ্য পরিবর্তন করুন</h5>
    <form class="" action="{{ route('transaction-item-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-3 pr-lg-0">
                <div class="input-group">
                    <label class="sr-only">Sector</label>
                    <select class="form-control" name="transaction_sector_id" style="border-radius: 4px" required>
                        <option value="">--খাত সিলেক্ট করুন--</option>
                        @foreach(sectors() as $sector)
                            <option value="{{ $sector->id }}">খাত: {{ $sector->name }}</option>
                        @endforeach
{{--                        <option value="new">নতুন খাত</option>--}}
                    </select>
{{--                    <input type="text" name="sector_name" class="form-control" style="display: none" id="newSectorName" placeholder="খাতের নাম" aria-label="Sector Name">--}}
                </div>
            </div>

            <div class="col-lg-3 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">একাউন্টের নাম</label>
                    <input type="text" name="account_name" class="form-control" value="{{ old('account_name') }}" placeholder="একাউন্টের নাম লিখুন">
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">একাউন্টের ধরণ</label>
                    <select class="form-control" name="account_type" required>
                        <option value="">--একাউন্টের ধরণ--</option>
                        <option value="Debit">ধরণঃ ডেবিট</option>
                        <option value="Credit">ধরণঃ ক্রেডিট</option>
                        {{--                        <option value="All">All</option>--}}
                    </select>
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="মোবাইল নং">
                </div>
            </div>

            <div class="col-lg-2 pr-lg-0">
                <div class="form-group">
                    <label class="sr-only">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="ঠিকানা">
                </div>
            </div>

            <input type="hidden" name="id"> <input type="hidden" name="sl">

            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> আপডেট করুন</button>
            </div>
        </div>
    </form>
</div>
