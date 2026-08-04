@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Follow-up | 검체 정보</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">검체 정보</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                대변 검체 획득일
            </th>
            <td colspan="3" class="text-left">
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
                혈액 검체 획득일
            </th>
            <td colspan="3" class="text-left">
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
                조직 검체 획득일
            </th>
            <td colspan="3" class="text-left">
                <div class="form-group date">
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center">
                    <img src="/assets/image/icon/ic_cal.png" alt="">
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">조직 검체 상세 정보</th>
        </tr>
        <tr>
            <th scope="row">
                취득 검체 개수
            </th>
            <td colspan="3" class="text-left">
                <div class="form-group">
                    정상 부위 : <input type="text" name="" id="" class="form-item line small text-center"> 개,
                    병변 부위 : <input type="text" name="" id="" class="form-item line small text-center"> 개
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                의뢰 검체 개수
            </th>
            <td colspan="3" class="text-left">
                <div class="form-group">
                    정상 부위 : <input type="text" name="" id="" class="form-item line small text-center"> 개,
                    병변 부위 : <input type="text" name="" id="" class="form-item line small text-center"> 개
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                조직 채취 부위
            </th>
            <td colspan="3" class="text-left">
                <div class="checkbox-wrap">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Rectum</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> S colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> D colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> T colon</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> A colon</div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Cecum</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Terminal ileum</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">Rectum 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">S colon 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">D colon 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">T colon 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">A colon 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">Cecum 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" scope="col" class="active">Terminal ileum 병리 결과</th>
        </tr>
        <tr>
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not inflammed</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> inflammed</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> active</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no cryptitis</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> cryptitis</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no crypt atrophy/architectural distortion</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> crypt atrophy/architectural distortion</label></div>
                </div>
            </td>
            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> no granuloma</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> granuloma</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                MES (UC인 경우)
            </th>
            <td class="text-left">
                <select name="" id="" class="form-item w-60p">
                    <option value="">선택</option>
                </select>
            </td>
            <th scope="row">
                UCEIS (UC인 경우)
            </th>
            <td class="text-left">
                <select name="" id="" class="form-item w-60p">
                    <option value="">선택</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                SES-CD (CD인 경우)
            </th>
            <td class="nbdr text-left">
                <select name="" id="" class="form-item w-60p">
                    <option value="">선택</option>
                </select>
            </td>
            <td colspan="2" class="nbdl"></td>
        </tr>
        </tbody>
    </table>
</div>