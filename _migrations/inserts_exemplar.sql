
--Editoras
INSERT INTO editora (nome) VALUE ('Fantasy - Casa da Palavra');
INSERT INTO editora (nome) VALUE ('Rocco');


--Autores
INSERT INTO autor (nome, historia) VALUE ('J. K. Rowling', '');
INSERT INTO autor (nome, historia) VALUE ('Affonso Solano', '');

--LIVROS
INSERT INTO livro (editora_id, nome, dataPublicacao, dataCadastro, imgCapa, sinopse, quantidadeDiasEmprestimo) 
    VALUES (
        5, 
        'O Espadachim de Carvão', 
        '2013-01-01', 
        NOW(), 
        'public/imagens/livros/espadachim_de_carvao20130101.jpg', 
        'KURGALA É UM MUNDO abandonado por Quatro Deuses. Adapak é filho de um deles. E agora ele está sendo caçado. Perseguido por um misterioso grupo de assassinos, o jovem de pele cor de carvão se vê obrigado a deixar a ilha sagrada onde cresceu e a desbravar um mundo hostil e repleto de criaturas exóticas. Munido de uma sabedoria ímpar, mas dotado de uma inocência rara, ele agora precisará colocar em prática todo o conhecimento que adquiriu em seu isolamento para descobrir quem são seus inimigos. Mesmo que isso possa comprometer alguns dos segredos mais antigos de Kurgala.',
         15)


INSERT INTO autores_livros (livro_id,autor_id,autorPrincipal) VALUES (5,25,1)


INSERT INTO livro (editora_id, nome, dataPublicacao, dataCadastro, imgCapa, sinopse, quantidadeDiasEmprestimo) 
    VALUES (
        15, 
        'Harry Potter e a pedra filosofal', 
        '2017-08-19', 
        NOW(), 
        'public/imagens/livros/harry_potter_e_a_pedra_filosofal20170819.jpg', 
        'Harry Potter é um garoto cujos pais, feiticeiros, foram assassinados por um poderosíssimo bruxo quando ele ainda era um bebê. Ele foi levado, então, para a casa dos tios que nada tinham a ver com o sobrenatural. Pelo contrário. Até os 10 anos, Harry foi uma espécie de gata borralheira: maltratado pelos tios, herdava roupas velhas do primo gorducho, tinha óculos remendados e era tratado como um estorvo. No dia de seu aniversário de 11 anos, entretanto, ele parece deslizar por um buraco sem fundo, como o de Alice no país das maravilhas, que o conduz a um mundo mágico. Descobre sua verdadeira história e seu destino: ser um aprendiz de feiticeiro até o dia em que terá que enfrentar a pior força do mal, o homem que assassinou seus pais. O menino de olhos verde, magricela e desengonçado, tão habituado à rejeição, descobre, também, que é um herói no universo dos magos. Potter fica sabendo que é a única pessoa a ter sobrevivido a um ataque do tal bruxo do mal e essa é a causa da marca em forma de raio que ele carrega na testa. Ele não é um garoto qualquer, ele sequer é um feiticeiro qualquer ele é Harry Potter, símbolo de poder, resistência e um líder natural entre os sobrenaturais. A fábula, recheada de fantasmas, paredes que falam, caldeirões, sapos, unicórnios, dragões e gigantes, não é, entretanto, apenas um passatempo.',
         20)


INSERT INTO autores_livros (livro_id,autor_id,autorPrincipal) VALUES (15,5,1)


--Exemplares

INSERT INTO exemplar (livro_id, doacao_id, isbn, localizacao, dataCadastro, status)
    VALUES 
        (5, null, '8532530788', 'c-10', NOW(), 'DISPONIVEL'),
        (5, null, '8532530789', 'c-10', NOW(), 'DISPONIVEL'),
        (5, null, '8532530790', 'c-10', NOW(), 'DISPONIVEL'),
        (5, null, '8532530791', 'c-10', NOW(), 'DISPONIVEL'),
        (5, null, '8532530792', 'c-10', NOW(), 'DISPONIVEL')


INSERT INTO exemplar (livro_id, doacao_id, isbn, localizacao, dataCadastro, status)
    VALUES 
        (15, null, '8577343340', 'b-32', NOW(), 'DISPONIVEL'),
        (15, null, '8577343341', 'b-32', NOW(), 'DISPONIVEL'),
        (15, null, '8577343342', 'b-32', NOW(), 'DISPONIVEL'),
        (15, null, '8577343343', 'b-32', NOW(), 'DISPONIVEL'),
        (15, null, '8577343344', 'b-32', NOW(), 'DISPONIVEL')

