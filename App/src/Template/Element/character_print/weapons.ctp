<h3>Weapons</h3>

<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Weapon</th>
            <th>Qty</th>
            <th>Skill</th>
            <th>Damage</th>
            <th>Range</th>
            <th>Crit</th>
            <th>Special</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="no-pagebreak">
        <tr ng-repeat="cw in character_weapons">
            <td>{{cw.weapon.name}}</td>
            <td>{{cw.quantity}}</td>
            <td>{{cw.weapon.skill.name}}</td>
            <td>{{cw.weapon.damage}}</td>
            <td>{{cw.weapon.range.name}}</td>
            <td>{{cw.weapon.crit}}</td>
            <td>{{cw.weapon.special}}</td>
            <td>
                <i ng-show="cw.equipped">equipped</i>
            </td>
        </tr>
    </tbody>
</table>

