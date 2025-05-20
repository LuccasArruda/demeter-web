
<form class="cadastro-ambiente" action="<?= site_url('ambiente/salvar') ?>" method="post" enctype="multipart/form-data">
  <a class="retornar" href="<?= site_url('/') ?>">← Retornar</a>

  <div class="painel">
    <img src="<?= base_url('assets/ilustracao-ambiente.svg') ?>" alt="Ambiente" class="ilustracao" />
    <div class="formulario">
      <h1>Cadastrar Novo Ambiente</h1>

      <div class="linha">
        <input type="text" name="nome" placeholder="Nome" required />
      </div>

      <div class="linha">
        <input type="text" name="cep" placeholder="CEP" required />
        <input type="text" name="cidade" placeholder="Cidade" required />
        <input type="text" name="estado" placeholder="Estado" required />
      </div>

      <div class="linha">
        <input type="text" name="rua" placeholder="Rua" required />
        <input type="text" name="bairro" placeholder="Bairro" required />
      </div>

      <div class="radio-group">
        <label>
          <input type="radio" name="tipo" value="pessoal" checked />
          Ambiente Pessoal
        </label>
        <label>
          <input type="radio" name="tipo" value="profissional" />
          Ambiente Profissional
        </label>
      </div>

      <div class="aviso d-none" id="aviso-pessoal">
        <i class="bi bi-info-circle"></i>
        <p class="texto">Ambientes do tipo <strong>Pessoal</strong> só podem ter uma rede elétrica</p>
      </div>
    </div>
  </div>

  <label class="upload">
    <img src="<?= base_url('assets/upload.svg') ?>" alt="Upload" />
    <span>Insira uma foto do Ambiente</span>
    <p>Clique ou arraste uma foto</p>
    <input type="file" name="foto" accept="image/*" hidden />
  </label>

  <button type="submit">Cadastrar</button>
</form>

<script>
  document.querySelectorAll('input[name="tipo"]').forEach(radio => {
    radio.addEventListener('change', function () {
      document.getElementById('aviso-pessoal').classList.toggle('d-none', this.value !== 'pessoal');
    });
  });
</script>
