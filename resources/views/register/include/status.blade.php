<div class="table-contop">
    <p><strong>최종 저장일시</strong> {{ empty($register->updated_at) ? '' : $register->updated_at->locale('ko')->isoFormat('YYYY-MM-DD, A hh:mm:ss') }}</p>

    <div class="checkbox-wrap full-right">
        <div>
            <label class="checkbox-group">
                <input type="checkbox" name="status" id="status" class="status-target" {{ (($register->status ?? '') === 'C') ? 'checked' : '' }} onclick="return false;"> {{ $registerConfig['tab'][$type][$tab] }} 입력 상태
            </label>
        </div>
    </div>
</div>