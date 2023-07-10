    function mascaraCPF(event) {
    let input = event.target // pegando o imput com o "event.target" (pega o evento apontado)

    //para modificar o valor demtro do input "input.value"
    if (!input.value) return "" //se estiver vazio o value não deve ocorrer nada

    input.value = input.value.replace(/\D/g,'') //Tudo que não for dígito será trocado por '' (vazio)
    /* 
    "/\D" - Pega o que não for dígito
    "/g" - Varre todas ocorrencia
    */
    input.value= input.value.replace(/(\d{3})(\d)/,"$1.$2")  //Após 3 digitos irá ser inserio um "."
    input.value= input.value.replace(/(\d{3})(\d)/,"$1.$2") //Após 3 digitos irá ser inserio um "."
    input.value= input.value.replace(/(\d{3})(\d)/,"$1-$2") //Após 3 digitos irá ser inserio um "-"
    return input.value
  }


  //------------------------------Semestre
  function mascaraSemestre(event) {
    let input = event.target 

    if (!input.value) return ""

    input.value = input.value.replace(/\D/g,'')

    input.value= input.value.replace(/(\d{2})(\d)/,"$1/$2")  
    return input.value
  }


