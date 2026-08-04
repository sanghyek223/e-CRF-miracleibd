@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 진단 시점 영상</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">진단 시점 영상</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                최초 영상의학 검사일
            </th>
            <td colspan="3" class="text-left">
                <div class="form-group date">
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center">
                    <img src="/assets/image/icon/ic_cal.png" alt="">
                    <div class="checkbox-wrap inline ml-10">
                        <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Unknown</label></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Severity
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> mild</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> moderate</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> severe</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Involved segment
            </th>
            <td colspan="3" class="text-left">
                <div class="checkbox-wrap n5">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> ileum</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> terminal ileum</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> IC valve</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Cecum</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> A colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> T colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> D colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> S colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Rectum</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Fistula
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> Perianal</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Enteroenteric</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Enterocolic</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Stricture
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Present</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Abscess
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Present</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>

    </script>
@endpush