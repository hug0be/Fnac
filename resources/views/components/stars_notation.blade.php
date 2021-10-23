<p class="notice_card_note"> 
    @if($note)
        <span class="notice_value_note">{{ round($note,2) }} : </span>
        @for($i=0; $i < (int)$note; $i++)
        <i class="fas fa-star notice_icon_note" style="color: #f1c40f"></i>
        @endfor
        @for($i=0; $i < 5-(int)$note; $i++)
        <i class="fas fa-star notice_icon_note"></i>
        @endfor
    @else
        <span class="notice_value_note">{{ "Pas de notes" }}</span>
    @endif
</p>