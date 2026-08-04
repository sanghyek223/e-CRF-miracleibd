<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | ER/Admission</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row">
                ER/Admission 발생 유무
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> Yes</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | ER/Admission</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th colspan="4" class="active has-btn nbdb">
                ER/Admission
                <button type="submit" class="btn btn-small color-type3" title="추가">행 추가</button><!--// 최대 10개까지 추가 -->
            </th>
        </tr>
        <tr>
            <td colspan="4" class="has-tbl nobd">
                <!--// 최대 10개까지 추가 -->
                <table class="inner-tbl">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: auto;">
                        <col style="width: 21%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">구분</th>
                        <th scope="col">사유</th>
                        <th scope="col">방문/입원일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">
                            1
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            2
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            3
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            4
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            5
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            6
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            7
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            8
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            9
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            10
                            <a href="#n" class="btn btn-detail-del" title="삭제">−</a>
                        </th>
                        <td>
                            <div class="radio-wrap text-center">
                                <div><label class="radio-group"><input type="radio" name="" id=""> ER</label></div>
                                <div><label class="radio-group"><input type="radio" name="" id=""> Admission</label></div>
                            </div>
                        </td>
                        <td class="text-left">
                            <input type="text" name="" id="" class="form-item full">
                        </td>
                        <td>
                            <div class="form-group date">
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center"> /
                                <input type="text" name="" id="" class="form-item line small text-center">
                                <img src="/assets/image/icon/ic_cal.png" alt="">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>