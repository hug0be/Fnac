<div>
    @if($errors->has($name))
        <p class="input_message error">
            {{$errors->first($name)}}
        </p>
    @endif
</div>