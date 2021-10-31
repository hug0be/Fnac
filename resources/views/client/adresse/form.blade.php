<form method="POST" action="{{ route("createAdresse") }}">
    @csrf
    <p>

        <label for="adr_nom">Nom de l'adresse : </label>
        <input type="text" name="adr_nom" id="" value="{{old("adr_nom")}}">
    </p>
    <p>

        <label for="adr_type">Type d'adresse : </label>
        <select name="adr_type" id="pays-select">
            <option value="Livraison" {{ old("adr_type")=="Livraison" ? "selected" : "" }}>Livraison</option>
            <option value="Facturation" {{ old("adr_type")=="Facturation" ? "selected" : "" }}>Facturation</option>
            
        </select>
    </p>
    <p>

        <label for="adr_rue">Rue : </label>
        <input type="text" name="adr_rue" id="" value="{{old("adr_rue")}}">
    </p>
    <p>

        <label for="adr_complementrue">Complement de rue : </label>
        <input type="text" name="adr_complementrue" id="" value="{{old("adr_complementrue")}}">
    </p>
    <p>

        <label for="adr_cp">Code postale : </label>
        <input type="text" name="adr_cp" id="" value="{{old("adr_cp")}}">
    </p>
    
    <p>

        <label for="adr_ville">Ville : </label>
        <input type="text" name="adr_ville" id="" value="{{old("adr_ville")}}">
    </p>
    <p>

        <label for="pays-select">Pays : </label>
        
        <select name="pay_id" id="pays-select">
            <option value="">--Veuillez selectionner un pays--</option>
            @foreach ($paysList as $pays)
            <option value="{{ $pays->id() }}" {{ old("pay_id")==$pays->id() ? "selected" : "" }}>{{ $pays->nom() }}</option>
            @endforeach
        </select>
    </p>

    <Button type="submit">Ajouter</Button>
    </form>