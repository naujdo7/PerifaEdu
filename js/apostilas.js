/* ══════════════════════════════════════════
   apostilas.js — PerifaEdu
   Dados das apostilas + lógica de navegação,
   conclusão de apostilas e integração com API
══════════════════════════════════════════ */

// ── Dados das apostilas organizados por nível e ano ──
const dadosApostilas = {
  fundamental1: {
    titulo: 'Ensino Fundamental I',
    anos: {
      '1º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Introdução às Letras', url: '../conteudos/1ano/1º Ano - Português - Introdução às Letras (Premium).pdf' },
            { titulo: 'Vogais e Consoantes', url: '../conteudos/1ano/1º Ano - Português - Vogais e Consoantes (Premium).pdf' },
            { titulo: 'Primeiras Palavras', url: '../conteudos/1ano/1º Ano - Português - Primeiras Palavras (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Números de 0 a 10', url: '../conteudos/1ano/1º Ano - Matemática - Números de 0 a 10 (Premium).pdf' },
            { titulo: 'Adição Simples', url: '../conteudos/1ano/1º Ano - Matemática - Adição Simples (Premium).pdf' },
            { titulo: 'Subtração Básica', url: '../conteudos/1ano/1º Ano - Matemática - Subtração Básica (Premium).pdf' }
          ],
          'Ciências': [
            { titulo: 'Animais e Plantas', url: '../conteudos/1ano/1º Ano - Ciências - Animais e Plantas (Premium).pdf' },
            { titulo: 'Corpo Humano', url: '../conteudos/1ano/1º Ano - Ciências - Corpo Humano (Premium).pdf' },
            { titulo: 'Estações do Ano', url: '../conteudos/1ano/1º Ano - Ciências - Estações do Ano (Premium).pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Leitura e Escrita', url: '../conteudos/2ano/2º Ano - Português - Leitura e Escrita (Premium).pdf' },
            { titulo: 'Sílabas e Palavras', url: '../conteudos/2ano/2º Ano - Português - Sílabas e Palavras (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Números até 100', url: '../conteudos/2ano/2º Ano - Matemática - Números até 100 (Premium).pdf' },
            { titulo: 'Multiplicação Introdução', url: '../conteudos/2ano/2º Ano - Matemática - Multiplicação Introdução (Premium).pdf' }
          ],
          'Ciências': [
            { titulo: 'Seres Vivos', url: '../conteudos/2ano/2º Ano - Ciências - Seres Vivos (Premium).pdf' }
          ],
          'História': [
            { titulo: 'História da Família', url: '../conteudos/2ano/2º Ano - História - História da Família (Premium).pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Separação de Sílabas', url: '../conteudos/3ano/3º Ano - Português - Separação de Sílabas (Premium).pdf' },
            { titulo: 'Pontuação Básica', url: '../conteudos/3ano/3º Ano - Português - Pontuação Básica (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Multiplicação', url: '../conteudos/3ano/3º Ano - Matemática - Multiplicação (Premium).pdf' },
            { titulo: 'Divisão Simples', url: '../conteudos/3ano/3º Ano - Matemática - Divisão Simples (Premium).pdf' }
          ],
          'Ciências': [
            { titulo: 'Habitat e Nicho', url: '../conteudos/3ano/3º Ano - Ciências - Habitat e Nicho (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Mapa do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_geografia.pdf' }
          ]
        }
      },
      '4º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise de Textos', url: '../conteudos/4ano/4º Ano - Português - Análise de Textos (Premium).pdf' },
            { titulo: 'Concordância Verbal', url: '../conteudos/4ano/4º Ano - Português - Concordância Verbal (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Frações Básicas', url: '../conteudos/4ano/4º Ano - Matemática - Frações Básicas (Premium).pdf' },
            { titulo: 'Números Decimais', url: '../conteudos/4ano/4º Ano - Matemática - Números Decimais (Premium).pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Solar', url: '../conteudos/4ano/4º Ano - Ciências - Sistema Solar (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Regiões do Brasil', url: '../conteudos/4ano/4º Ano - Geografia - Regiões do Brasil (Premium).pdf' }
          ]
        }
      },
      '5º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Gêneros Textuais', url: '../conteudos/5ano/5º Ano - Português - Gêneros Textuais (Premium).pdf' },
            { titulo: 'Interpretação de Textos', url: '../conteudos/5ano/5º Ano - Português - Interpretação de Textos (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Operações com Decimais', url: '../conteudos/5ano/5º Ano - Matemática - Operações com Decimais (Premium).pdf' },
            { titulo: 'Geometria Básica', url: '../conteudos/5ano/5º Ano - Matemática - Geometria Básica (Premium).pdf' }
          ],
          'Ciências': [
            { titulo: 'Mudanças Climáticas', url: '../conteudos/5ano/5º Ano - Ciências - Mudanças Climáticas (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Continentes e Oceanos', url: '../conteudos/5ano/5º Ano - Geografia - Continentes e Oceanos (Premium).pdf' }
          ]
        }
      }
    }
  },

  fundamental2: {
    titulo: 'Ensino Fundamental II',
    anos: {
      '6º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Morfologia: Classes de Palavras', url: '../conteudos/6ano/6º Ano - Português - Morfologia Classes de Palavras (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Potenciação e Radiciação', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Raiz Quadrada', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Célula e Vida', url: '../conteudos/6ano/6º Ano - Ciências - Célula e Vida (Premium).pdf' }
          ],
          'História': [
            { titulo: 'Pré-História Brasileira', url: '../conteudos/6ano/6º Ano - História - Pré-História Brasileira (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Cartografia', url: '../conteudos/6ano/6º Ano - Geografia - Cartografia (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Simple', url: '../conteudos/6ano/6º Ano - Inglês - Present Simple (Premium).pdf' }
          ]
        }
      },
      '7º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Sintaxe da Oração', url: '../conteudos/7ano/7º Ano - Português - Sintaxe da Oração (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Expressões Algébricas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Nervoso', url: '../conteudos/7ano/7º Ano - Ciências - Sistema Nervoso (Premium).pdf' }
          ],
          'História': [
            { titulo: 'Brasil Colonial', url: '../conteudos/7ano/7º Ano - História - Brasil Colonial (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Clima e Vegetação', url: '../conteudos/7ano/7º Ano - Geografia - Clima e Vegetação (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Continuous', url: '../conteudos/7ano/7º Ano - Inglês - Present Continuous (Premium).pdf' }
          ]
        }
      },
      '8º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise Sintática Completa', url: '../conteudos/8ano/8º Ano - Português - Análise Sintática Completa (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 1º Grau', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Reprodução Humana', url: '../conteudos/8ano/8º Ano - Ciências - Reprodução Humana (Premium).pdf' }
          ],
          'História': [
            { titulo: 'Independência do Brasil', url: '../conteudos/8ano/8º Ano - História - Independência do Brasil (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'População Brasileira', url: '../conteudos/8ano/8º Ano - Geografia - População Brasileira (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Simple Past', url: '../conteudos/8ano/8º Ano - Inglês - Simple Past (Premium).pdf' }
          ]
        }
      },
      '9º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Período Composto', url: '../conteudos/9ano/9º Ano - Português - Período Composto (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 2º Grau', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Evolução e Seleção Natural', url: '../conteudos/9ano/9º Ano - Ciências - Evolução e Seleção Natural (Premium).pdf' }
          ],
          'História': [
            { titulo: 'República Velha', url: '../conteudos/9ano/9º Ano - História - República Velha (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Economia Brasileira', url: '../conteudos/9ano/9º Ano - Geografia - Economia Brasileira (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Perfect', url: '../conteudos/9ano/9º Ano - Inglês - Present Perfect (Premium).pdf' }
          ]
        }
      }
    }
  },

  medio: {
    titulo: 'Ensino Médio',
    anos: {
      '1º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Portuguesa', url: '../conteudos/1med/1º Ano - Português - Literatura Portuguesa (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Funções Quadráticas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química Geral e Inorgânica', url: '../conteudos/1med/1º Ano - Química - Química Geral e Inorgânica (Premium).pdf' }
          ],
          'Física': [
            { titulo: 'Mecânica e Cinemática', url: '../conteudos/1med/1º Ano - Física - Mecânica e Cinemática (Premium).pdf' }
          ],
          'Biologia': [
            { titulo: 'Citologia e Genética Básica', url: '../conteudos/1med/1º Ano - Biologia - Citologia e Genética Básica (Premium).pdf' }
          ],
          'História': [
            { titulo: 'Idade Moderna', url: '../conteudos/1med/1º Ano - História - Idade Moderna (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Geopolítica Mundial', url: '../conteudos/1med/1º Ano - Geografia - Geopolítica Mundial (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Future Tense', url: '../conteudos/1med/1º Ano - Inglês - Future Tense (Premium).pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Brasileira Colonial', url: '../conteudos/2med/2º Ano - Português - Literatura Brasileira Colonial (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Trigonometria', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química Orgânica', url: '../conteudos/2med/2º Ano - Química - Química Organica (Premium).pdf' }
          ],
          'Física': [
            { titulo: 'Termodinâmica e Ondas', url: '../conteudos/2med/2º Ano - Física - Termodinâmica e Ondas (Premium).pdf' }
          ],
          'Biologia': [
            { titulo: 'Ecologia e Evolução', url: '../conteudos/2med/2º Ano - Biologia - Ecologia e Evolução (Premium).pdf' }
          ],
          'História': [
            { titulo: 'Iluminismo e Revoluções', url: '../conteudos/2med/2º Ano - História - Iluminismo e Revoluções (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Sustentabilidade Global', url: '../conteudos/2med/2º Ano - Geografia - Sustentabilidade Global (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Conditional Structures', url: '../conteudos/2med/2º Ano - Inglês - Conditional Structures (Premium).pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Moderna e ENEM', url: '../conteudos/3med/3º Ano - Português - Literatura Moderna e ENEM (Premium).pdf' }
          ],
          'Matemática': [
            { titulo: 'Geometria Analítica e ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química para o ENEM', url: '../conteudos/3med/3º Ano - Química - Química para o ENEM (Premium).pdf' }
          ],
          'Física': [
            { titulo: 'Eletromagnetismo e ENEM', url: '../conteudos/3med/3º Ano - Física - Eletromagnetismo e ENEM (Premium).pdf' }
          ],
          'Biologia': [
            { titulo: 'Biologia Molecular e Genética', url: '../conteudos/3med/3º Ano - Biologia - Biologia Molecular e Genética (Premium).pdf' }
          ],
          'História': [
            { titulo: 'História Contemporânea', url: '../conteudos/3med/3º Ano - História - História Contemporânea (Premium).pdf' }
          ],
          'Geografia': [
            { titulo: 'Brasil no Século XXI', url: '../conteudos/3med/3º Ano - Geografia - Brasil no Século XXI (Premium).pdf' }
          ],
          'Inglês': [
            { titulo: 'Advanced Reading e ENEM', url: '../conteudos/3med/3º Ano - Inglês - Advanced Reading e ENEM (Premium).pdf' }
          ]
        }
      }
    }
  }
};

// ── Ícones das disciplinas ──
const iconosDisciplinas = {
  'Português': '📝',
  'Matemática': '🔢',
  'Ciências': '🔬',
  'Química': '⚗️',
  'Física': '⚡',
  'Biologia': '🧬',
  'História': '📖',
  'Geografia': '🌍',
  'Inglês': '🌐',
  'Arte': '🎨',
  'Educação Física': '⚽'
};

// ── Estado ──
let nivelSelecionado = null;
let anoSelecionado = null;
let apostilasConcluidas = new Set();

// ── DOM ──
const nivelButtons = document.querySelectorAll('.nivel-btn');
const anosSection = document.getElementById('anos-section');
const anosContainer = document.getElementById('anos-container');
const anosTitulo = document.getElementById('anos-titulo');
const disciplinasSection = document.getElementById('disciplinas-section');
const disciplinasGrid = document.getElementById('disciplinas-grid');
const tituloDisciplinas = document.getElementById('titulo-disciplinas');
const modalPdf = document.getElementById('modal-pdf');
const modalClose = document.getElementById('modal-close');
const pdfIframe = document.getElementById('pdf-iframe');
const btnVoltarNivel = document.getElementById('btn-voltar-nivel');
const btnVoltarAno = document.getElementById('btn-voltar-ano');
const toast = document.getElementById('apostilas-toast');

// ── Inicialização ──
document.addEventListener('DOMContentLoaded', () => {
  carregarProgressoApostilas();

  // Voltar botões
  if (btnVoltarNivel) {
    btnVoltarNivel.addEventListener('click', () => {
      anosSection.style.display = 'none';
      disciplinasSection.style.display = 'none';
      nivelButtons.forEach(b => b.classList.remove('active'));
      nivelSelecionado = null;
    });
  }

  if (btnVoltarAno) {
    btnVoltarAno.addEventListener('click', () => {
      disciplinasSection.style.display = 'none';
      anosSection.style.display = 'block';
      setTimeout(() => anosSection.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
    });
  }
});

// ── Cliques nos botões de nível ──
nivelButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    nivelButtons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    nivelSelecionado = btn.getAttribute('data-nivel');
    anoSelecionado = null;
    disciplinasSection.style.display = 'none';

    const dados = dadosApostilas[nivelSelecionado];
    anosTitulo.textContent = dados.titulo + ' — Selecione o ano';
    anosSection.style.display = 'block';
    preencherAnos();

    setTimeout(() => anosSection.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
  });
});

// ── Preenche botões de anos ──
function preencherAnos() {
  anosContainer.innerHTML = '';
  const dados = dadosApostilas[nivelSelecionado];

  Object.keys(dados.anos).forEach(ano => {
    const btn = document.createElement('button');
    btn.className = 'ano-btn';
    btn.textContent = ano;
    btn.addEventListener('click', () => selecionarAno(ano, btn));
    anosContainer.appendChild(btn);
  });
}

// ── Seleciona un ano ──
function selecionarAno(ano, btnElement) {
  document.querySelectorAll('.ano-btn').forEach(b => b.classList.remove('active'));
  btnElement.classList.add('active');

  anoSelecionado = ano;
  disciplinasSection.style.display = 'block';

  const dados = dadosApostilas[nivelSelecionado].anos[ano];
  tituloDisciplinas.textContent = `${dadosApostilas[nivelSelecionado].titulo} — ${ano}`;

  preencherDisciplinas(dados.disciplinas);

  setTimeout(() => disciplinasSection.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
}

// ── Preenche grid de disciplinas ──
function preencherDisciplinas(disciplinas) {
  disciplinasGrid.innerHTML = '';

  Object.keys(disciplinas).forEach(nomeDisciplina => {
    const apostilas = disciplinas[nomeDisciplina];
    const icone = iconosDisciplinas[nomeDisciplina] || '📚';

    const card = document.createElement('div');
    card.className = 'disciplina-card';

    const header = document.createElement('div');
    header.className = 'disciplina-header';
    header.innerHTML = `
      <span class="disciplina-icon">${icone}</span>
      <h3>${nomeDisciplina}</h3>
    `;

    const body = document.createElement('div');
    body.className = 'disciplina-body';

    const lista = document.createElement('ul');
    lista.className = 'apostila-list';

    apostilas.forEach(apostila => {
      const id = gerarApostilaId(nivelSelecionado, anoSelecionado, nomeDisciplina, apostila.titulo);
      const isConcluida = apostilasConcluidas.has(id);

      const item = document.createElement('li');
      item.className = 'apostila-item' + (isConcluida ? ' concluido' : '');
      item.id = 'ap-item-' + id;

      item.innerHTML = `
        <div class="apostila-item-top">
          <div class="apostila-file-icon">📄</div>
          <div class="apostila-item-info">
            <p class="apostila-title">${apostila.titulo}</p>
            <span class="apostila-concluido-badge">
              <i class="fas fa-check-circle"></i> Concluída
            </span>
          </div>
        </div>
        <div class="apostila-buttons">
          <button class="apostila-btn btn-visualizar" onclick="visualizarPDF('${apostila.url.replace(/'/g, "\\'")}')">
            <i class="fas fa-eye"></i> Visualizar
          </button>
          <a class="apostila-btn btn-download" href="${apostila.url}" download="${apostila.titulo.replace(/'/g, "\\'")}">
            <i class="fas fa-download"></i> Download
          </a>
          <button class="apostila-btn btn-concluir ${isConcluida ? 'concluido' : ''}"
                  id="btn-concluir-${id}"
                  onclick="toggleConcluidoApostila('${id}', '${nomeDisciplina}')">
            ${isConcluida
          ? '<i class="fas fa-check-circle"></i> Concluído'
          : '<i class="far fa-circle"></i> Concluído'}
          </button>
        </div>
      `;

      lista.appendChild(item);
    });

    body.appendChild(lista);
    card.appendChild(header);
    card.appendChild(body);
    disciplinasGrid.appendChild(card);
  });
}

// ── Visualiza PDF ──
function visualizarPDF(url) {
  pdfIframe.src = url;
  modalPdf.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

// ── Fecha modal ──
modalClose.addEventListener('click', () => {
  modalPdf.style.display = 'none';
  pdfIframe.src = '';
  document.body.style.overflow = '';
});

modalPdf.addEventListener('click', e => {
  if (e.target === modalPdf) {
    modalPdf.style.display = 'none';
    pdfIframe.src = '';
    document.body.style.overflow = '';
  }
});

// ── Download PDF ──
function downloadPDF(url, titulo) {
  const link = document.createElement('a');
  link.href = url;
  link.download = titulo + '.pdf';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// ── Carrega progresso da API ──
async function carregarProgressoApostilas() {
  try {
    const res = await fetch(window.baseUrl + 'pages/api_progresso.php');
    if (!res.ok) return; // usuário não logado — sem problema
    const data = await res.json();
    if (data.sucesso && Array.isArray(data.concluidas)) {
      apostilasConcluidas = new Set(data.concluidas);
    }
  } catch (e) {
    // silencioso — usuário pode não estar logado
  }
}

// ── Toggle: marca OU desmarca apostila em tempo real ──
async function toggleConcluidoApostila(apostilaId, nomeDisciplina) {
  const btn = document.getElementById('btn-concluir-' + apostilaId);
  const item = document.getElementById('ap-item-' + apostilaId);
  if (!btn || btn.dataset.loading === '1') return;

  const jaConcluida = apostilasConcluidas.has(apostilaId);
  const acao = jaConcluida ? 'desmarcar' : 'marcar';

  // Feedback imediato (optimistic UI)
  btn.dataset.loading = '1';
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

  try {
    const body = new URLSearchParams({ acao, apostila_id: apostilaId });
    const res = await fetch(window.baseUrl + 'pages/api_progresso.php', { method: 'POST', body });
    const data = await res.json();

    
    if (data.sucesso) {
      if (acao === 'marcar') {
        apostilasConcluidas.add(apostilaId);
        item.classList.add('concluido');
        btn.classList.add('concluido');
        btn.innerHTML = '<i class="fas fa-check-circle"></i> Concluído';
        mostrarToastApostilas('"' + nomeDisciplina + '" marcada como concluída! 🎉');
      } else {
        apostilasConcluidas.delete(apostilaId);
        item.classList.remove('concluido');
        btn.classList.remove('concluido');
        btn.innerHTML = '<i class="far fa-circle"></i> Concluído';
        mostrarToastApostilas('"' + nomeDisciplina + '" desmarcada.');
      }
    } else {
      // Não logado ou erro — restaura estado anterior
      btn.innerHTML = jaConcluida
        ? '<i class="fas fa-check-circle"></i> Concluído'
        : '<i class="far fa-circle"></i> Concluído';
      mostrarToastApostilas('Faça login para salvar seu progresso.', true);
    }
  } catch (e) {
    // Erro de rede — restaura
    btn.innerHTML = jaConcluida
      ? '<i class="fas fa-check-circle"></i> Concluído'
      : '<i class="far fa-circle"></i> Concluído';
  } finally {
    btn.dataset.loading = '0';
  }
}

// ── Helpers ──
function gerarApostilaId(nivel, ano, materia, titulo) {
  return slugify(nivel + '_' + ano + '_' + materia + '_' + titulo);
}

function slugify(str) {
  return str.toLowerCase()
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
    .replace(/[^a-z0-9]+/g, '_')
    .replace(/^_|_$/g, '');
}

let toastApostilaTimer;
function mostrarToastApostilas(msg, erro = false) {
  const toastEl = document.getElementById('apostilas-toast');
  const msgEl = document.getElementById('apostilas-toast-msg');
  if (!toastEl || !msgEl) return;
  msgEl.textContent = msg;
  toastEl.style.background = erro
    ? 'linear-gradient(135deg, #dc2626, #ef4444)'
    : 'linear-gradient(135deg, #16a34a, #22c55e)';
  toastEl.classList.add('show');
  clearTimeout(toastApostilaTimer);
  toastApostilaTimer = setTimeout(() => toastEl.classList.remove('show'), 3500);
}
