SELECT
  EXTRACT(year FROM datum) AS year,
  CAST(SUM((ar * IF(a.arfolyam is NULL, d.alap_arfolyam, a.arfolyam) * (e.mennyiseg))) AS DECIMAL(10,2)) AS forgalom_HU
FROM eladas AS e
LEFT JOIN deviza AS d ON d.id = e.deviza_id
LEFT JOIN arfolyam AS a ON a.deviza_id = e.deviza_id AND EXTRACT(YEAR FROM e.datum) = a.ev AND EXTRACT(MONTH FROM e.datum) = a.ho
LEFT JOIN konyv AS k ON e.konyv_id = k.id
GROUP BY EXTRACT(year FROM datum);