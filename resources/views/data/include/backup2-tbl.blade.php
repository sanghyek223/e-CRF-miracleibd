<table class="cst-table" id="backup2-tbl">
    <caption class="hide">백업</caption>
    <colgroup>
        <col style="width: 15%;">
        <col style="width: 20%;">
        <col>
        <col style="width: 20%;">
    </colgroup>

    <thead>
    <tr>
        <th scope="col">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox field="backup2_all" value="Y" text="ALL DATA"/>
            </div>
        </th>
        <th scope="col" colspan="2">입력폼</th>
        <th scope="col">건수</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <th scope="row" rowspan="4" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup2_FU" field="backup2_FU" value="Y" class="backup-chk"/>
            </div>
        </th>
        <th scope="row" rowspan="4" class="text-left">{{ $registerConfig['type']['FU']['name'] }}</th>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_BX" field="backup2_FU_BX" value="Y" :text="$registerConfig['tab']['FU']['BX']" class="backup-chk backup2-FU"/>
            </div>
        </td>
        <td rowspan="4">{{ number_format($backup2_count) }} 건</td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_LAB" field="backup2_FU_LAB" value="Y" :text="$registerConfig['tab']['FU']['LAB']" class="backup-chk backup2-FU"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_ENDO" field="backup2_FU_ENDO" value="Y" :text="$registerConfig['tab']['FU']['ENDO']" class="backup-chk backup2-FU"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_IMG" field="backup2_FU_IMG" value="Y" :text="$registerConfig['tab']['FU']['IMG']" class="backup-chk backup2-FU"/>
            </div>
        </td>
    </tr>
    </tbody>
</table>