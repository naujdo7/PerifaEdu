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
            { titulo: 'Introdução às Letras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Vogais e Consoantes', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Primeiras Palavras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' }
          ],
          'Matemática': [
            { titulo: 'Números de 0 a 10', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Adição Simples', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Subtração Básica', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Animais e Plantas', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Corpo Humano', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Estações do Ano', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Leitura e Escrita', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_portugues.pdf' },
            { titulo: 'Sílabas e Palavras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Números até 100', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Multiplicação Introdução', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Seres Vivos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'História da Família', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_historia.pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Separação de Sílabas', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_portugues.pdf' },
            { titulo: 'Pontuação Básica', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Multiplicação', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Divisão Simples', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Habitat e Nicho', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_ciencias.pdf' }
          ],
          'Geografia': [
            { titulo: 'Mapa do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_geografia.pdf' }
          ]
        }
      },
      '4º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise de Textos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_portugues.pdf' },
            { titulo: 'Concordância Verbal', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Frações Básicas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Números Decimais', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Solar', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_ciencias.pdf' }
          ],
          'Geografia': [
            { titulo: 'Regiões do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_geografia.pdf' }
          ]
        }
      },
      '5º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Gêneros Textuais', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_portugues.pdf' },
            { titulo: 'Interpretação de Textos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Operações com Decimais', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Geometria Básica', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Mudanças Climáticas', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_ciencias.pdf' }
          ],
          'Geografia': [
            { titulo: 'Continentes e Oceanos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_geografia.pdf' }
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
            { titulo: 'Morfologia: Classes de Palavras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Potenciação e Radiciação', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Raiz Quadrada', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Célula e Vida', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'Pré-História Brasileira', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Cartografia', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Simple', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_ingles.pdf' }
          ]
        }
      },
      '7º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Sintaxe da Oração', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Expressões Algébricas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Nervoso', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'Brasil Colonial', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Clima e Vegetação', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Continuous', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_ingles.pdf' }
          ]
        }
      },
      '8º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise Sintática Completa', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 1º Grau', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Reprodução Humana', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'Independência do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'População Brasileira', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Simple Past', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_ingles.pdf' }
          ]
        }
      },
      '9º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Período Composto', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 2º Grau', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Evolução e Seleção Natural', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'República Velha', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Economia Brasileira', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Perfect', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
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
            { titulo: 'Literatura Portuguesa', url: 'https://educapes.capes.gov.br/bitstream/capes/560994/2/Apostila%20Literatura%20-%20Produto%20Educacional.pdf' }
          ],
          'Matemática': [
            { titulo: 'Funções Quadráticas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química Geral e Inorgânica', url: 'https://educapes.capes.gov.br/bitstream/capes/205370/4/APOSTILA_QUIMICA_GERAL_E_INORGANICA.pdf' }
          ],
          'Física': [
            { titulo: 'Mecânica e Cinemática', url: 'https://educapes.capes.gov.br/bitstream/capes/178953/2/Produto_Educacional_Apostila_de_Fisica.pdf' }
          ],
          'Biologia': [
            { titulo: 'Citologia e Genética Básica', url: 'https://educapes.capes.gov.br/bitstream/capes/174064/4/PPT_Biologia%20Modular.pdf' }
          ],
          'História': [
            { titulo: 'Idade Moderna', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/historia_em_1_ano_apostila.pdf' }
          ],
          'Geografia': [
            { titulo: 'Geopolítica Mundial', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/geografia_em_1_ano_apostila.pdf' }
          ],
          'Inglês': [
            { titulo: 'Future Tense', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Brasileira Colonial', url: 'https://educapes.capes.gov.br/bitstream/capes/560994/2/Apostila%20Literatura%20-%20Produto%20Educacional.pdf' }
          ],
          'Matemática': [
            { titulo: 'Trigonometria', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química Orgânica', url: 'https://educapes.capes.gov.br/bitstream/capes/205370/4/APOSTILA_QUIMICA_GERAL_E_INORGANICA.pdf' }
          ],
          'Física': [
            { titulo: 'Termodinâmica e Ondas', url: 'https://educapes.capes.gov.br/bitstream/capes/178953/2/Produto_Educacional_Apostila_de_Fisica.pdf' }
          ],
          'Biologia': [
            { titulo: 'Ecologia e Evolução', url: 'https://educapes.capes.gov.br/bitstream/capes/174064/4/PPT_Biologia%20Modular.pdf' }
          ],
          'História': [
            { titulo: 'Iluminismo e Revoluções', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/historia_em_2_ano_apostila.pdf' }
          ],
          'Geografia': [
            { titulo: 'Sustentabilidade Global', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/geografia_em_2_ano_apostila.pdf' }
          ],
          'Inglês': [
            { titulo: 'Conditional Structures', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Moderna e ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/560994/2/Apostila%20Literatura%20-%20Produto%20Educacional.pdf' }
          ],
          'Matemática': [
            { titulo: 'Geometria Analítica e ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química para o ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/205370/4/APOSTILA_QUIMICA_GERAL_E_INORGANICA.pdf' }
          ],
          'Física': [
            { titulo: 'Eletromagnetismo e ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/178953/2/Produto_Educacional_Apostila_de_Fisica.pdf' }
          ],
          'Biologia': [
            { titulo: 'Biologia Molecular e Genética', url: 'https://educapes.capes.gov.br/bitstream/capes/174064/4/PPT_Biologia%20Modular.pdf' }
          ],
          'História': [
            { titulo: 'História Contemporânea', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/historia_em_3_ano_apostila.pdf' }
          ],
          'Geografia': [
            { titulo: 'Brasil no Século XXI', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/geografia_em_3_ano_apostila.pdf' }
          ],
          'Inglês': [
            { titulo: 'Advanced Reading e ENEM', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
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
    const res = await fetch('/PerifaEdu/PerifaEdu/pages/api_progresso.php');
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
    const res = await fetch('/PerifaEdu/PerifaEdu/pages/api_progresso.php', { method: 'POST', body });
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
