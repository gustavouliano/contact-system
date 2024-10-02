"use client";

import { useEffect, useState } from "react";
import { useRouter, useSearchParams } from "next/navigation";
import { updateContact } from "@/requests/contacts-requests";

export default function Page() {
  const [id, setId] = useState(0);
  const [personId, setPersonId] = useState(0);
  const [type, setType] = useState(0);
  const [description, setDescription] = useState("");
  const router = useRouter();
  const searchParams = useSearchParams();

  useEffect(() => {
    setId(Number(searchParams.get("id")) ?? 0);
    setPersonId(Number(searchParams.get("personId")) ?? 0);
    setType(Number(searchParams.get("type")) ?? 0);
    setDescription(searchParams.get("description") ?? "");
  }, []);

  const handleSubmit = async (event: React.FormEvent) => {
    event.preventDefault();
    await updateContact(id, { type: Boolean(type), description });
    router.push(`/person/${personId}`);
  };

  return (
    <div className="flex flex-col mx-auto w-4/6 mt-4 gap-4 items-center">
      <h1 className="text-2xl">Editar contato ID: {id}</h1>
      <form onSubmit={handleSubmit} className="w-full">
        <div className="mb-3">
          <label htmlFor="type" className="form-label">
            Tipo:
          </label>
          <select
            id="type"
            value={type}
            onChange={(e) => setType(Number(e.target.value))}
            className="form-select"
            required
          >
            <option value={0}>Telefone</option>
            <option value={1}>Email</option>
          </select>
        </div>
        <div className="mb-3">
          <label htmlFor="description" className="form-label">
            Descrição:
          </label>
          <input
            type="text"
            id="description"
            value={description}
            onChange={(e) => setDescription(e.target.value)}
            className="form-control"
            required
          />
        </div>
        <button type="submit" className="btn btn-success">
          Atualizar contato
        </button>
      </form>
    </div>
  );
}
