<html>

<form action="/categories">
    {{ csrf_field() }}

    <div class="container">
        <label><b>Text Area(max 5000 words)</b></label>
        <textarea rows="4" cols="50" maxlength="5000" name="tweet">
        </textarea>

        <button type="submit">Submit</button>
        <input type="checkbox" checked="checked">
    </div>
</form>
</html>