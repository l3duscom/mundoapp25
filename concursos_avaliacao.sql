SELECT
    a.inscricao_id,
    u.nome,
    i.nome_social AS nome_inscricao,
    c.nome AS nome_concurso,
    AVG(a.nota_1) AS media_nota_1,
    AVG(a.nota_2) AS media_nota_2,
    AVG(a.nota_3) AS media_nota_3,
    AVG(a.nota_4) AS media_nota_4,
    AVG(a.nota_total) AS media_nota_total
FROM
    avaliacoes a
JOIN
    inscricoes i ON a.inscricao_id = i.id
JOIN
    concursos c ON i.concurso_id = c.id
    JOIN
    usuarios u ON i.user_id = u.id
GROUP BY
    a.inscricao_id, i.nome, c.nome;